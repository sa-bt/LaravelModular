<?php

use Sabt\Media\Http\Controllers\MediaController;

\Illuminate\Support\Facades\Route::group([],function ($router){
    $router->get('/media/{media}/download',[MediaController::class,'download'])->name('media.download');
});
