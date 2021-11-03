<?php


use Illuminate\Support\Facades\Route;
use Sabt\Course\Http\Controllers\CourseController;

//"namespace"=>"Sabt\Category\Http\Controllers",
Route::group(['middleware' => ['web', 'auth', 'verified']], function ($router)
{

    $router->resource('courses', CourseController::class);
    $router->put('courses/{course}/accept',[CourseController::class,'accept'])->name('courses.accept');
    $router->put('courses/{course}/reject',[CourseController::class,'reject'])->name('courses.reject');
    $router->put('courses/{course}/lock',[CourseController::class,'lock'])->name('courses.lock');

});
