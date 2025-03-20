<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EmergencyContact extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'relation',
        'phone',
        'email',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
