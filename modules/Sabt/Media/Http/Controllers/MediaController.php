<?php

namespace Sabt\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sabt\Media\Models\Media;
use Sabt\Media\Services\MediaUploadService;

class MediaController extends Controller
{
    public function download($media, Request $request)
    {
        $media = Media::query()->find($media);
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        return MediaUploadService::stream($media);
    }
}
