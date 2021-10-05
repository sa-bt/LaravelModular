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
    Route::get('/test', function ()
    {
        return  User::factory(1)->create();
    });

});
