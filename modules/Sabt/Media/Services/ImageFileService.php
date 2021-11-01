<?php


namespace Sabt\Media\Services;


use Intervention\Image\Facades\Image;

class ImageFileService
{
    protected static $sizes = ['100','300', '600'];

    public static function upload($file)
    {
        $fileName  = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir       = 'app\public\\';
        $file->move(storage_path($dir), $fileName . '.' . $extension);
        $path = $dir . '\\' . $fileName . '.' . $extension;
        return self::resize(storage_path($path), $dir, $fileName, $extension);
    }

    private static function resize($img, $dir, $fileName, $extension)
    {
        $img                = Image::make($img);
        $images['original'] = $fileName . $extension;
        foreach (self::$sizes as $size)
        {
            $images[$size] = $fileName . '_' . $size . '.' . $extension;
            $img->resize($size, null, function ($aspect)
            {
                $aspect->aspectRatio();
            })->save(storage_path($dir) . $fileName . '_' . $size . '.' . $extension);
        }
        return $images;
    }
}
