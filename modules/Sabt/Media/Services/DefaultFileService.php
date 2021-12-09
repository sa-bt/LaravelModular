<?php


namespace Sabt\Media\Services;


use Illuminate\Support\Facades\Storage;

class DefaultFileService
{
    public static function delete($media, $direction)
    {
//        dd($media,$direction);
        foreach ($media->files as $file) {
            Storage::delete($direction . $file);
        }
    }
}
