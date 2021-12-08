<?php


namespace Sabt\Media\Services;


use Illuminate\Support\Facades\Storage;

class DefaultFileService
{
    public static function delete($media)
    {
        foreach ($media->files as $file)
        {
//            dd($media);
            Storage::delete('public\\' . $file);
        }
}
}
