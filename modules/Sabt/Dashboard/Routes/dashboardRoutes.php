<?php

use Illuminate\Support\Facades\Route;
use Sabt\Dashboard\Http\Controllers\DashboardController;


Route::group(['namespace'=>'Sabt\Dashboard\Http\Controller','middleware'=>['web','auth','verified']],function ($router){
    $router->get('/home', [DashboardController::class, 'index'])->name('home');

});
