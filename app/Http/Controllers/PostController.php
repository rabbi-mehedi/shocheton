<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __invoke()
    {
        // Start building the query with eager loading for efficiency.
        $query = Post::with(['user', 'votes', 'comments.user'])
        ->orderBy('created_at', 'desc');

        // Optionally filter posts by category if the 'category' query parameter exists.
        if (isset($request) && $request->has('category')) {
            $category = $request->input('category');
            $query->where('category', $category);
        }

        // Retrieve posts with pagination (adjust page size as needed)
        $posts = $query->paginate(10);
        return view('forums',compact('posts'));
    }
    // Store a new post (called when the user clicks “Post”)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content'    => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx',
            'location'   => 'nullable|string',
            'lat'        => 'nullable|numeric',
            'lng'        => 'nullable|numeric',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id();

        if ($request->hasFile('attachment')) {
            // Store the file in the 'public/attachments' folder
            $path = $request->file('attachment')->store('attachments', 'public');
            $data['attachment'] = $path;
        }

        $post = Post::create($data);

        return redirect()->back()->with('success', 'Post created successfully!');
    }
}
