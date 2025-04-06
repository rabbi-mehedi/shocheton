<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __invoke()
    {
        //
    }

    // Vote on a post using vote tracking (upvote or downvote)
    public function vote(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        // Vote type: 1 for upvote, -1 for downvote.
        $voteType = (int) $request->input('vote');

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

        // Optionally, recalculate total upvotes and downvotes from the votes table.
        $upvotes   = $post->votes()->where('vote', 1)->count();
        $downvotes = $post->votes()->where('vote', -1)->count();

        return response()->json([
            'success'    => true,
            'upvotes'    => $upvotes,
            'downvotes'  => $downvotes,
        ]);
    }

    
}
