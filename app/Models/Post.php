<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'content',
        'category',
        'attachment',
        'location',
        'lat',
        'lng',
        'upvotes_count',
        'downvotes_count',
        'anonymous'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }
    
    /**
     * Get the display name for the post author
     * Returns a pseudonym if post is anonymous
     */
    public function getAuthorDisplayName()
    {
        if ($this->anonymous) {
            // Generate a consistent but random pseudonym for this user+post combination
            $seed = $this->user_id . '-' . $this->id; 
            $adjectives = ['Thoughtful', 'Brave', 'Caring', 'Hopeful', 'Sincere', 'Honest', 'Kind', 'Wise', 'Gentle', 'Resilient'];
            $nouns = ['Speaker', 'Voice', 'Member', 'Supporter', 'Friend', 'Advocate', 'Participant', 'Contributor', 'Person', 'Individual'];
            
            // Use the seed to consistently select the same adjective and noun for this post
            srand(crc32($seed));
            $adjective = $adjectives[array_rand($adjectives)];
            $noun = $nouns[array_rand($nouns)];
            
            return "$adjective $noun";
        }
        
        return $this->user->name;
    }
}
