<?php
namespace Sabt\Media\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/MediaRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Media');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations/');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
        $this->mergeConfigFrom(__DIR__.'/../Config/Media.php','Media');
    }

}
