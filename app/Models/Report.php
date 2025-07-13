<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use App\Models\Offender;
use App\Models\Extortionist;
use App\Models\ReportFlag;


class Report extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'offender_id',
        'extortionist_id',
        'offender_relation_to_victim',
        'police_status', 
        'police_station',
        'needs_legal_support',
        'needs_ngo_support',
        'privacy_level',
        'contact_permission',
        'additional_details', 
        'verified',
        'report_type', // Add field to distinguish between offense types
    ];

    public function verified()
    {
        return $this->verified;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offender()
    {
        return $this->hasOne(Offender::class);
    }
    
    public function extortionist()
    {
        return $this->hasOne(Extortionist::class);
    }

    public function flags()
    {
        return $this->hasMany(ReportFlag::class);
    }
}
