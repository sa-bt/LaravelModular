<?php


namespace Sabt\User\Providers;


use Carbon\Laravel\ServiceProvider;
use Database\Seeders\DatabaseSeeder;
use Sabt\User\Database\Factories\UserFactory;
use Sabt\User\Database\Seeders\UserSeeder;
use Sabt\User\Models\User;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        config()->set('auth.providers.users.model', User::class);
        DatabaseSeeder::$seeders[] = UserSeeder::class;
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/Front', 'User');

    }

}
