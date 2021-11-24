<?php


namespace Sabt\RolePermissions\Providers;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;
use Sabt\RolePermissions\Models\Permission;
use Sabt\RolePermissions\Models\Role;
use Sabt\RolePermissions\Policies\RolePolicy;

class RolePermissionServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'RolePermissions');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/RolePermissionsRoutes.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        DatabaseSeeder::$seeders[] = RoleAndPermissionSeeder::class;
        Gate::policy(Role::class, RolePolicy::class);
        Gate::before(function ($user)
        {
            return $user->hasPermissionTo(Permission::SUPER_ADMIN_PERMISSION) ? true : null;
        });

    }

    public function boot()
    {
        config()->set('Sidebar.items.rolePermission', [
            "icon"  => "i-role-permissions",
            "url"   => route('roles.index'),
            "title" => "دسترسی ها",
            "permission"=>Permission::MANAGE_ROLES_PERMISSION
        ]);
    }
}
