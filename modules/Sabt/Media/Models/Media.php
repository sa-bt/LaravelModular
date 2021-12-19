<?php


namespace Sabt\Media\Models;


use Illuminate\Database\Eloquent\Model;
use Sabt\Media\Services\MediaUploadService;

class Media extends Model
{
    protected $guarded = [];

    protected $casts=[
        'files'=>'json'
    ];

    protected static function booted()
    {
        static::deleting(function ($media){
            MediaUploadService::delete($media);
        });
    }

    public function getThumbAttribute()
    {
        return MediaUploadService::thumb($this);
    }
}
