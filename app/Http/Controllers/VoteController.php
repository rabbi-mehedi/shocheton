<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function __invoke()
    {
        //
    }

    // Vote on a post using vote tracking (upvote or downvote)
    public function votePost(Request $request, $postId)
    {
        // Validate the input
        $request->validate([
            'vote' => 'required|in:1,-1',
        ]);

        // Make sure user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to vote',
                'redirect' => route('login')
            ], 401);
        }

        $post = Post::findOrFail($postId);
        $user = Auth::user();

        // Vote type: 1 for upvote, -1 for downvote.
        $voteType = (int) $request->input('vote');

        try {
            // Check if the user already voted on this post.
            $existingVote = $post->votes()->where('user_id', $user->id)->first();

            if ($existingVote) {
                if ($existingVote->vote === $voteType) {
                    // Toggle off: remove the vote if the same vote is clicked again.
                    $existingVote->delete();
                } else {
                    // Change the vote type.
                    $existingVote->update(['vote' => $voteType]);
                }
            } else {
                // Create a new vote record.
                $post->votes()->create([
                    'user_id' => $user->id,
                    'vote'    => $voteType,
                ]);
            }

            // Calculate total upvotes and downvotes from the votes table.
            $upvotes   = $post->votes()->where('vote', 1)->count();
            $downvotes = $post->votes()->where('vote', -1)->count();

            return response()->json([
                'success'    => true,
                'upvotes'    => $upvotes,
                'downvotes'  => $downvotes,
                'message'    => 'Vote recorded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to record vote: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Vote on a comment or reply using vote tracking (upvote or downvote)
    public function voteComment(Request $request, $commentId)
    {
        // Validate the input
        $request->validate([
            'vote' => 'required|in:1,-1',
        ]);

        // Make sure user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to vote',
                'redirect' => route('login')
            ], 401);
        }

        $comment = Comment::findOrFail($commentId);
        $user = Auth::user();

        // Vote type: 1 for upvote, -1 for downvote.
        $voteType = (int) $request->input('vote');

        try {
            // Check if the user already voted on this comment.
            $existingVote = $comment->votes()->where('user_id', $user->id)->first();

            if ($existingVote) {
                if ($existingVote->vote === $voteType) {
                    // Toggle off: remove the vote if the same vote is clicked again.
                    $existingVote->delete();
                } else {
                    // Change the vote type.
                    $existingVote->update(['vote' => $voteType]);
                }
            } else {
                // Create a new vote record.
                $comment->votes()->create([
                    'user_id' => $user->id,
                    'vote'    => $voteType,
                ]);
            }

            // Calculate total upvotes and downvotes from the votes table.
            $upvotes   = $comment->votes()->where('vote', 1)->count();
            $downvotes = $comment->votes()->where('vote', -1)->count();

            return response()->json([
                'success'    => true,
                'upvotes'    => $upvotes,
                'downvotes'  => $downvotes,
                'message'    => 'Vote recorded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to record vote: ' . $e->getMessage()
            ], 500);
        }
    }
}
