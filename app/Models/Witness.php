<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Witness extends Model
{
    protected $fillable = [
        'report_id',
        'name',
        'contact',
        'statement',
    ];
}
