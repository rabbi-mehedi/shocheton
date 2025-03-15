<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EmergencyAlert extends Model
{
    protected $fillable = [
        'user_id',
        'lat',
        'lng',
    ];

    // If you have a users table, you can define a relationship:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
