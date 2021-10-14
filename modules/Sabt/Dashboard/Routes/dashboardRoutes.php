<?php

use Illuminate\Support\Facades\Route;
use Sabt\Dashboard\Http\Controllers\DashboardControllers;


Route::group(['namespace'=>'Sabt\Dashboard\Http\Controller','middleware'=>['web','auth','verified']],function ($router){
    $router->get('/home', [DashboardControllers::class,'index'])->name('home');

});
