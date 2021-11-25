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
    auth()->user()->assignRole(\Sabt\RolePermissions\Models\Role::SUPER_ADMIN_ROLE);
    return auth()->user()->roles;
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
