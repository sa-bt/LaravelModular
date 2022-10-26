<?php


namespace Sabt\Media\Contracts;


use Illuminate\Http\UploadedFile;
use Sabt\Media\Models\Media;

interface FileServiceContract
{
    public static function upload(UploadedFile $file, string $fileName, string $dir);

    public static function delete(Media $media, string $direction);

    public static function thumb(Media $media);

    public static function stream(Media $media, string $direction);
}
