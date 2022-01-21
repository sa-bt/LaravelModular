<?php

use Illuminate\Support\Facades\Route;
use Sabt\Front\Http\Controllers\FrontController;

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/course/{course}', [FrontController::class, 'singleCourse'])->name('singleCourse');
});
