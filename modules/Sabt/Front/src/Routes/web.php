<?php

use Illuminate\Support\Facades\Route;
use Sabt\Front\Http\Controllers\FrontController;

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/c-{slug}', [FrontController::class, 'singleCourse'])->name('singleCourse');
    Route::get('/tutors/{username}', [FrontController::class, 'singleTutor'])->name('singleTutor');
});
