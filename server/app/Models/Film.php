<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Film extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $appends = [
        'image'
    ];

    protected $hidden = ['media'];
    protected $fillable = [
        "name",
        "description",
        "release_date",
        "rating",
        "price",
        "user_id",
        "country",
        "genre",
    ];

    public static $ruleFilms = [
        "name" => "required|string|unique:films,name",
        "release_date" => "required|date",
        "genre" => "required|alpha",
        "country" => "required|alpha",
        "price" => "required|integer",
        "rating" => "required|numeric",
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function getImageAttribute()
    {
        if (!$this->hasMedia()) return false;
        return $this->getMedia()->first()->getUrl();
    }
}
