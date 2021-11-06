<?php

use Illuminate\Support\Facades\Route;
use Sabt\Category\Http\Controllers\CategoryController;

//"namespace"=>"Sabt\Category\Http\Controllers",
Route::group(['middleware'=>['web','auth','verified']],function ($router){

    $router->resource('categories', CategoryController::class)->middleware(['permission:manage categories']);

});
