<?php


namespace Sabt\Media\Services;


use Sabt\Media\Contracts\FileServiceContract;
use Sabt\Media\Models\Media;

class MediaUploadService
{
    private static $file;
    private static $dir;

    public static function upload($file)
    {
        $extension = self::getExtension($file);
        foreach (config('Media.MediaTypeService') as $mediaType => $service)
            if (in_array($extension, $service['extensions']))
            {
                self::$dir = $service['direction'];
                self::$file=$file;
                return self::uploadHandler(new $service['handler'], $mediaType);
            }

    }

    public static function delete($media)
    {
        switch ($media->type)
        {
            case 'image':
                ImageFileService::delete($media);
        }
    }

    /**
     * @param $file
     * @param $service
     * @param $mediaType
     * @return Media
     */
    public static function uploadHandler(FileServiceContract $service, $mediaType): Media
    {
        $media           = new Media();
        $media->files    = $service::upload(self::$file, self::fileNameGenerator(), self::$dir);
        $media->type     = $mediaType;
        $media->user_id  = auth()->id();
        $media->filename = self::$file->getClientOriginalName();
        $media->save();
        return $media;
    }

    private static function getExtension($file)
    {
        return strtolower($file->getClientOriginalExtension());
    }

    /**
     * @return string
     */
    private static function fileNameGenerator(): string
    {
        return time().uniqid();
    }
}
