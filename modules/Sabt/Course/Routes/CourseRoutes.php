<?php


use Illuminate\Support\Facades\Route;
use Sabt\Course\Http\Controllers\CourseController;

//"namespace"=>"Sabt\Category\Http\Controllers",
Route::group(['middleware' => ['web', 'auth', 'verified']], function ($router)
{

    $router->resource('courses', CourseController::class);

});
