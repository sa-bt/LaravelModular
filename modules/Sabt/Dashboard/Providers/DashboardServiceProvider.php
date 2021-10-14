<?php


namespace Sabt\Dashboard\Providers;


use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/dashboardRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Dashboard');
    }
}
