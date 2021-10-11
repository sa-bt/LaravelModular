<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Sabt\User\Http\Controllers\Auth\ForgotPasswordController;
use Sabt\User\Http\Controllers\Auth\LoginController;
use Sabt\User\Http\Controllers\Auth\RegisterController;
use Sabt\User\Http\Controllers\Auth\ResetPasswordController;
use Sabt\User\Http\Controllers\Auth\VerificationController;
use Sabt\User\Models\User;

Route::group([
                 'namespace'  => 'Sabt\User\Http\Controllers',
                 'middleware' => 'web'
             ], function ()
{
    Route::post('email/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

    //Login

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    //Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Reset Password
    Route::get('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
//    Route::post('/password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    //Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

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
        return new \Sabt\User\Mail\VerifyCodeMail(9999556);
    });

});
