<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Sabt\User\Http\Controllers\Auth\VerificationController;
use Sabt\User\Models\User;

Route::group([
                 'namespace'  => 'Sabt\User\Http\Controllers',
                 'middleware' => 'web'
             ], function ()
{
    Auth::routes(['verify' => true]);
    Route::post('email/verify',[VerificationController::class,'verify'])->name('verification.verify');
//    Route::get('/verify_sabt/{user}/', function ()
//    {
//        if (request()->hasValidSignature())
//            return "salaaaaaaaaam";
//
//        return "Nooo";
//    })->name('verify_sabt');
//
//    Route::get('/test', function ()
//    {
//        $url = \Illuminate\Support\Facades\URL::temporarySignedRoute('verify_sabt', now()->addSeconds(20), ['user' => 2]);
//        dd($url);
//    });
 Route::get('/test', function ()
    {
        return new \Sabt\User\Mail\VerifyCodeMail( 9999556);
    });

});
