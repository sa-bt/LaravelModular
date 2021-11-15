<?php


namespace Sabt\User\Providers;


use Carbon\Laravel\ServiceProvider;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Sabt\User\Database\Factories\UserFactory;
use Sabt\User\Database\Seeders\UserSeeder;
use Sabt\User\Models\User;
use Sabt\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        config()->set('auth.providers.users.model', User::class);
        DatabaseSeeder::$seeders[] = UserSeeder::class;
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/Front', 'User');
        Gate::policy(User::class, UserPolicy::class);
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        config()->set('Sidebar.items.users', [
            "icon"  => "i-users",
            "url"   => route('users.index'),
            "title" => "مدیریت کاربران",
        ]);

    }

}
