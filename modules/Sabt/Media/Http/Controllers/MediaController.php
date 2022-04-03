<?php

namespace Sabt\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Sabt\Media\Models\Media;

class MediaController extends Controller
{
    public function download(Media $media)
    {
        return 'yes';
    }
}
