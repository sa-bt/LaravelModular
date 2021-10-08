<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Sabt\User\Models\User;

Route::group([
                 'namespace'  => 'Sabt\User\Http\Controllers',
                 'middleware' => 'web'
             ], function ()
{
    Auth::routes(['verify' => true]);
    Route::get('/verify_sabt/{user}/', function ()
    {
        if (request()->hasValidSignature())
            return "salaaaaaaaaam";

        return "Nooo";
    })->name('verify_sabt');

    Route::get('/test', function ()
    {
        $url = \Illuminate\Support\Facades\URL::temporarySignedRoute('verify_sabt', now()->addSeconds(20), ['user' => 2]);
        dd($url);
    });

});
