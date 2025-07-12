<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Report;

class Extortionist extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = [
        'report_id',
        'name',
        'position',
        'political_affiliation',
        'business_name',
        'business_sector',
        'business_address_district',
        'business_address_upazila',
        'business_address_detail',
        'demanded_amount',
        'approach_method',
        'recurring_demand',
        'threat_description',
        'status',
        'risk_level'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
