<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyRepresentative extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'party_id',
        'designation',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function party()
    {
        return $this->belongsTo(PoliticalParty::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'party_representative_category');
    }
} 