<?php


namespace Sabt\RolePermissions\Providers;


use Illuminate\Support\ServiceProvider;

class RolePermissionServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views/','RolePermissions');
        $this->loadRoutesFrom(__DIR__.'/../Routes/RolePermissionsRoutes.php');

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
