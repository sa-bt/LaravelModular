<?php


namespace Sabt\Dashboard\Providers;


use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/dashboardRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Dashboard');
        $this->mergeConfigFrom(__DIR__.'/../Config/Sidebar.php','Sidebar');
    }

    public function boot()
    {
        $this->app->booted(function (){
            config()->set('Sidebar.items.dashboard',[
                "icon"=>"i-dashboard",
                "url"=>env('APP_URL').'/home',
                "title"=>"پیشخوان",
            ]);
        });

    }

}
