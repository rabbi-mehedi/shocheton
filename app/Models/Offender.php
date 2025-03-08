<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offender extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'age',
        'crime_description',
        'offense_type',
        'location',
        'status',
        'evidence',
        'risk_level'];
}
