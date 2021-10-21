<?php


use Illuminate\Support\Facades\Route;
use Sabt\RolePermissions\Http\Controllers\PermissionController;
use Sabt\RolePermissions\Http\Controllers\RoleController;

Route::group(['middleware' => ['web', 'auth', 'verified']], function ($router)
{

    $router->resource('roles', RoleController::class);
    $router->resource('permissions', PermissionController::class);

});
