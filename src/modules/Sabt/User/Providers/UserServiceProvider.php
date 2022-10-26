<?php


namespace Sabt\User\Providers;


use Carbon\Laravel\ServiceProvider;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Database\Factories\UserFactory;
use Sabt\User\Database\Seeders\UserSeeder;
use Sabt\User\Http\Middleware\StoreUserIp;
use Sabt\User\Models\User;
use Sabt\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        config()->set('auth.providers.users.model', User::class);
        DatabaseSeeder::$seeders[] = UserSeeder::class;
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/Front', 'User');
        Gate::policy(User::class, UserPolicy::class);
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
    }

    public function boot()
    {
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        config()->set('Sidebar.items.users', [
            "icon"       => "i-users",
            "url"        => env('APP_URL') . '/users',
            "title"      => "مدیریت کاربران",
            "permission" => Permission::MANAGE_USERS_PERMISSION

        ]);
        config()->set('Sidebar.items.profile', [
            "icon"  => "i-user__information",
            "url"   => env('APP_URL') . '/edit-profile',
            "title" => "اطلاعات کاربری",
        ]);

    }

}
