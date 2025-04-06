<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voteable_id',
        'voteable_type',
        'vote', // Use 1 for upvote, -1 for downvote
    ];

    // Define the polymorphic relation
    public function voteable()
    {
        return $this->morphTo();
    }

    // Each vote is made by a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
