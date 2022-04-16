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
        foreach (config('Media.MediaTypeService') as $mediaType => $service) {
            if (in_array($extension, $service['extensions'])) {
                self::$dir = $service['direction'];
                self::$file = $file;
                return self::uploadHandler(new $service['handler'], $mediaType);
            }
        }
    }

    public static function delete(Media $media)
    {
        foreach (config('Media.MediaTypeService') as $mediaType => $service) {
            if ($mediaType == $media->type)
                return $service['handler']::delete($media, $service['direction']);
        }
    }


    public static function uploadHandler(FileServiceContract $service, $mediaType): Media
    {
        $media = new Media();
        $media->files = $service::upload(self::$file, self::fileNameGenerator(), self::$dir);
        $media->type = $mediaType;
        $media->user_id = auth()->id();
        $media->filename = self::$file->getClientOriginalName();
        $media->save();
        return $media;
    }

    private static function getExtension($file)
    {
        return strtolower($file->getClientOriginalExtension());
    }


    private static function fileNameGenerator(): string
    {
        return time() . uniqid();
    }

    public static function thumb(Media $media)
    {
        foreach (config('Media.MediaTypeService') as $mediaType => $service) {
            if ($mediaType == $media->type)
                return $service['handler']::thumb($media);
        }
    }

    public static function getExtensions()
    {
        $extensions = [];
        foreach (config('Media.MediaTypeService') as $service) {
            foreach ($service['extensions'] as $extension) {
                $extensions[] = $extension;
            }
        }
        return implode(',',$extensions);
    }

    public static function stream(Media $media)
    {
        foreach (config('Media.MediaTypeService') as $mediaType => $service) {
            if ($mediaType == $media->type)
                return $service['handler']::stream($media, $service['direction']);
        }
    }
}
