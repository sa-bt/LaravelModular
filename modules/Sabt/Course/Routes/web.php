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


    Route::put('courses/{course}/lessons/{lesson}/accept',[LessonController::class,'accept'])->name('lessons.accept');
    Route::put('courses/{course}/lessons/{lesson}/reject',[LessonController::class,'reject'])->name('lessons.reject');
    Route::put('courses/{course}/lessons/{lesson}/lock',[LessonController::class,'lock'])->name('lessons.lock');
    Route::delete('courses/{course}/lessons',[LessonController::class,'deleteMultiple'])->name('lessons.deleteMultiple');
    Route::resource('courses/{course}/lessons', LessonController::class);

});
