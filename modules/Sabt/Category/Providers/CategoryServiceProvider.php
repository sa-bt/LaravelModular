<?php


namespace Sabt\Category\Providers;


use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/categoryRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Category');
    }
}
