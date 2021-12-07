<?php


namespace Sabt\Media\Services;


use Illuminate\Support\Facades\Storage;
use Sabt\Media\Contracts\FileServiceContract;
use Sabt\Media\Models\Media;

class VideoFileService implements FileServiceContract
{

    public static function upload($file,string $fileName, string $dir)
    {
        $extension=$file->getClientOriginalExtension();
        Storage::putFileAs($dir, $file, $fileName . '.' . $extension);
        return $dir . $fileName . '.' . $extension;
    }

    public static function delete(Media $media)
    {

    }
}
