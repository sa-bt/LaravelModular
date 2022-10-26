<?php


namespace Sabt\Media\Services;


use Illuminate\Support\Facades\Storage;
use Sabt\Media\Models\Media;

class DefaultFileService
{
    public static function delete($media, $direction)
    {
        foreach ($media->files as $file) {
            Storage::delete($direction . $file);
        }
    }

    public static function stream(Media $media, $direction)
    {
        $path = $media->type == 'image' ? $media->files['original'] : $media->files[0];
        $stream = Storage::readStream($direction . $path);
        return response()->stream(function () use ($stream) {
            while (ob_get_level() > 0) ob_get_flush();
            fpassthru($stream);
        });

    }
}
