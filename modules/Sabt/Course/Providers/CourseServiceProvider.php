<?php


namespace Sabt\Course\Providers;


use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/CourseRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Course');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations/');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot()
    {
        config()->set('Sidebar.items.courses',[
            "icon"=>"i-courses",
            "url"=>route('courses.index'),
            "title"=>"دسته بندی ها",
        ]);
    }
}
