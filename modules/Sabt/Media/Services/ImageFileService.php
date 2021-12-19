<?php


namespace Sabt\Media\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Sabt\Media\Contracts\FileServiceContract;

class ImageFileService extends DefaultFileService implements FileServiceContract
{
    protected static $sizes = ['100', '300', '600'];

    public static function upload($file, $fileName, $dir): array
    {
        $extension = $file->getClientOriginalExtension();
        Storage::putFileAs($dir, $file, $fileName . '.' . $extension);
        $path = $dir . $fileName . '.' . $extension;
        return self::resize(Storage::path($path), $dir, $fileName, $extension);
    }

    private static function resize($img, $dir, $fileName, $extension)
    {
        $img = Image::make($img);
        $images['original'] = $fileName . '.' . $extension;
        foreach (self::$sizes as $size) {
            $images[$size] = $fileName . '_' . $size . '.' . $extension;
            $img->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(Storage::path($dir) . $fileName . '_' . $size . '.' . $extension);
        }
        return $images;
    }

    public static function thumb($media)
    {
        return '/storage/'.$media->files[100];
    }

}
