<?php


namespace Sabt\Media\Services;


use Illuminate\Support\Facades\Storage;
use Sabt\Media\Contracts\FileServiceContract;
use Sabt\Media\Models\Media;

class VideoFileService extends  DefaultFileService implements FileServiceContract
{

    public static function upload($file, string $fileName, string $dir)
    {
        $extension = $file->getClientOriginalExtension();
        Storage::putFileAs($dir, $file, $fileName . '.' . $extension);
        return  [ $fileName . '.' . $extension];
    }

    public static function thumb($media)
    {
        return url('/img/video.jpg');
    }
}
