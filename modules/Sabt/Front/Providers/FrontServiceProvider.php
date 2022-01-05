<?php

namespace Sabt\Front\Providers;

use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__."/../Routes/web.php");
        $this->loadViewsFrom(__DIR__."/Resources/views","Front");
}

    public function boot()
    {

}
}
