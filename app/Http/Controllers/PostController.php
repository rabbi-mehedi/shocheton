<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __invoke(Request $request)
    {
        // Start building the query with eager loading for efficiency.
        $query = Post::with(['user', 'votes', 'comments.user', 'comments.replies.user'])
        ->orderBy('created_at', 'desc');

        // Optionally filter posts by category if the 'category' query parameter exists.
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category', $category);
        }

        // Retrieve posts with pagination (adjust page size as needed)
        $posts = $query->paginate(10);
        return view('forums', compact('posts'));
    }

    // Store a new post (called when the user clicks “Post”)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content'    => 'required|string',
            'category'   => 'nullable|string|max:255',
            'media.*'    => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,mp3,wav,ogg,pdf,doc,docx,xlsx|max:25600',
            'location'   => 'nullable|string',
            'lat'        => 'nullable|numeric',
            'lng'        => 'nullable|numeric',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id();

        // Create the post
        $post = Post::create($data);

        // Handle multiple media files
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $mediaFile) {
                // Determine the type of media (image, video, audio, document)
                $mimeType = $mediaFile->getMimeType();
                $collection = 'default';
                
                if (str_contains($mimeType, 'image')) {
                    $collection = 'images';
                } elseif (str_contains($mimeType, 'video')) {
                    $collection = 'videos';
                } elseif (str_contains($mimeType, 'audio')) {
                    $collection = 'audio';
                } else {
                    $collection = 'documents';
                }
                
                $post->addMedia($mediaFile)
                     ->toMediaCollection($collection);
            }
        }

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    // Delete a post via AJAX
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Make sure the authenticated user owns the post
        if ($post->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $post->delete();
        return response()->json(['success' => true]);
    }
}
