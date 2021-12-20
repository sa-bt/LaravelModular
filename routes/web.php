<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function ()
{
    return view('index');
});


Route::get('/test', function ()
{
    dd(\Sabt\Media\Services\MediaUploadService::getExtensions());
    $user = \Sabt\User\Models\User::find(6)->first();
    dd($user->course->count());
    $filename='ahmad.txt';

    $FH = fopen($filename, 'w') or die("Unable to open file!");
    fwrite($FH,$user);
    fclose($FH);

    $filename=\Illuminate\Support\Facades\Storage::putFileAs('public/backups/',$filename,$filename);
//    $dirname = dirname($filename);



//    auth()->user()->assignRole(\Sabt\RolePermissions\Models\Role::SUPER_ADMIN_ROLE);
//    return auth()->user()->roles;


});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
