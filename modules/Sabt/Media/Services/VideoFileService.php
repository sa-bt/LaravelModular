<?php


namespace Sabt\Media\Services;


use Illuminate\Support\Facades\Storage;

class VideoFileService
{

    public static function upload($file)
    {
        $fileName  = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir       = 'private\\';
        Storage::putFileAs($dir, $file, $fileName . '.' . $extension);
        return $dir . $fileName . '.' . $extension;
    }
}
