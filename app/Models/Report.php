<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Report extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'offender_id',
        'offender_relation_to_victim',
        'police_status', 
        'police_station',
        'needs_legal_support',
        'needs_ngo_support',
        'privacy_level',
        'contact_permission',
        'additional_details' 
    ];
    
}
