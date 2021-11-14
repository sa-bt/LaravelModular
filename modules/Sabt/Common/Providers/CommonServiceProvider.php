<?php


namespace Sabt\Common\Providers;


use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{


    public function boot()
    {
        require __DIR__."/../helpers.php";
    }
}
