<?php

use Illuminate\Support\Facades\Route;
use Sabt\User\Http\Controllers\Auth\ForgotPasswordController;
use Sabt\User\Http\Controllers\Auth\LoginController;
use Sabt\User\Http\Controllers\Auth\RegisterController;
use Sabt\User\Http\Controllers\Auth\ResetPasswordController;
use Sabt\User\Http\Controllers\Auth\VerificationController;
use Sabt\User\Http\Controllers\UserController;
use Sabt\User\Models\User;

Route::group(['middleware' => ['web', 'auth']], function ()
{
    Route::post('users/{user}/add/role', [UserController::class, 'addRole'])->name('users.addRole');
    Route::delete('users/{user}/remove/{role}/role', [UserController::class, 'removeRole'])->name('users.removeRole');
    Route::put('users/{user}/manualVerify', [UserController::class, 'manualVerify'])->name('users.manualVerify');
    Route::post('users/photo', [UserController::class, 'updatePhoto'])->name('users.photo');
    Route::get('users/profile', [UserController::class, 'editProfile'])->name('users.profile');
    Route::post('users/profile', [UserController::class, 'updateProfile'])->name('users.updateProfile');
//    Route::get('account/{username}', [UserController::class,'viewProfile'])->name('viewProfile');
    Route::resource('users', UserController::class);
});

Route::group(['middleware' => 'web'], function ()
{
    Route::post('email/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

    //Login

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('users.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    //Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Reset Password
    Route::get('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showVerifyCodeRequestForm'])->name('password.request');
    Route::get('/password/reset/send', [ForgotPasswordController::class, 'sendVerifyCodeEmail'])->name('password.sendVerifyCodeEmail');
    Route::post('/password/reset/checkVerifyCode', [ForgotPasswordController::class, 'checkVerifyCode'])
         ->middleware('throttle:5,1')
         ->name('password.checkVerifyCode');

    Route::get('/password/change', [ResetPasswordController::class, 'showResetForm'])
         ->middleware('auth')
         ->name('password.showResetForm');
    Route::post('/password/change', [ResetPasswordController::class, 'reset'])->name('password.update');

    //Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('users.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');



});

