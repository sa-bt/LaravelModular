<?php


namespace Sabt\User\Providers;


use Carbon\Laravel\ServiceProvider;
use Sabt\User\Database\Factories\UserFactory;
use Sabt\User\Models\User;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        config()->set('auth.providers.users.model', User::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');

    }

    public function provides()
    {
        return [UserFactory::class];
    }
}
