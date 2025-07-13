<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ExtorterIndividual extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = [
        'extortionist_id',
        'name',
        'nickname',
        'position',
        'phone',
        'description',
    ];

    public function extortionist()
    {
        return $this->belongsTo(Extortionist::class);
    }
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photos')
            ->useDisk('public');
    }
} 