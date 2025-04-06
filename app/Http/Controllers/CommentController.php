<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $validated = $request->validate([
            'content'   => 'required|string',
            'parent_id' => 'nullable|exists:comments,id', // if provided, it's a reply
        ]);

        $validated['post_id'] = $postId;
        $validated['user_id'] = Auth::id();

        Comment::create($validated);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    
}
