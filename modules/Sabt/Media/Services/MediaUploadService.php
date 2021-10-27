<?php


namespace Sabt\Media\Services;


class MediaUploadService
{
    public static function upload($file)
    {
        $extension =strtolower($file->getClientOriginalExtension());
    }
}
