<?php


use Illuminate\Support\Facades\Route;
use Sabt\Course\Http\Controllers\CourseController;
use Sabt\Course\Http\Controllers\SeasonController;
use Sabt\Course\Http\Controllers\LessonController;

//"namespace"=>"Sabt\Category\Http\Controllers",
Route::group(['middleware' => ['web', 'auth', 'verified']], function ()
{

    Route::put('courses/{course}/accept',[CourseController::class,'accept'])->name('courses.accept');
    Route::put('courses/{course}/reject',[CourseController::class,'reject'])->name('courses.reject');
    Route::put('courses/{course}/lock',[CourseController::class,'lock'])->name('courses.lock');
    Route::resource('courses', CourseController::class);


    Route::put('seasons/{season}/accept',[SeasonController::class,'accept'])->name('seasons.accept');
    Route::put('seasons/{season}/reject',[SeasonController::class,'reject'])->name('seasons.reject');
    Route::put('seasons/{season}/lock',[SeasonController::class,'lock'])->name('seasons.lock');
    Route::resource('seasons', SeasonController::class);


    Route::resource('courses/{course}/lessons', LessonController::class);

});
