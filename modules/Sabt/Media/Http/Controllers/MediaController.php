<?php

namespace Sabt\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sabt\Media\Models\Media;
use Sabt\Media\Services\MediaUploadService;

class MediaController extends Controller
{
    public function download(Media $media,Request $request)
    {
        if (!$request->hasValidSignature()){
            abort(401);
        }
        return MediaUploadService::stream($media);
    }
}
