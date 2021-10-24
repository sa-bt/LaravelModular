<?php


namespace Sabt\RolePermissions\Providers;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;

class RolePermissionServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views/','RolePermissions');
        $this->loadRoutesFrom(__DIR__.'/../Routes/RolePermissionsRoutes.php');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
        DatabaseSeeder::$seeders[]=RoleAndPermissionSeeder::class;

    }

    public function boot()
    {
        config()->set('Sidebar.items.rolePermission',[
            "icon"=>"i-role-permissions",
            "url"=>route('roles.index'),
            "title"=>"دسترسی ها",
        ]);
    }
}
