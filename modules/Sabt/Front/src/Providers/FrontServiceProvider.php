<?php

namespace Sabt\Front\Providers;

use Illuminate\Support\ServiceProvider;
use Sabt\Category\Repositories\CategoryRepository;
use Sabt\Course\Repositories\CourseRepository;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../Routes/web.php");
        $this->loadViewsFrom(__DIR__ . "./../Resources/views", "Front");

        view()->composer('Front::index',function($view){
           $categories=(new CategoryRepository())->tree();
           $latestCourses=(new CourseRepository())->latestCourses();
           $view->with(compact('categories','latestCourses'));
        });
    }

    public function boot()
    {

    }
}
