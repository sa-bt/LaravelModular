<?php


namespace Sabt\Category\Providers;


use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/categoryRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Category');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations/');
    }

    public function boot()
    {
        config()->set('Sidebar.items.categories',[
            "icon"=>"i-categories",
            "url"=>route('categories.index'),
            "title"=>"دسته بندی ها",
        ]);
    }
}
