<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'district'];

    public function partyRepresentatives()
    {
        return $this->belongsToMany(PartyRepresentative::class, 'party_representative_category');
    }
}
