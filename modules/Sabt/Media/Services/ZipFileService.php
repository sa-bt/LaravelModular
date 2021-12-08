<?php


namespace Sabt\Media\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Sabt\Media\Contracts\FileServiceContract;
use Sabt\Media\Models\Media;

class ZipFileService extends DefaultFileService implements FileServiceContract
{

    public static function upload(UploadedFile $file, string $fileName, string $dir): array
    {
        $extension = $file->getClientOriginalExtension();
        Storage::putFileAs($dir, $file, $fileName . '.' . $extension);
        return ["zip" => $dir . $fileName . '.' . $extension];
    }

}
