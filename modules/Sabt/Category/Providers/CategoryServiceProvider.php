<?php


namespace Sabt\Category\Providers;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Sabt\Category\Database\Seeders\CategorySeeder;
use Sabt\Category\Models\Category;
use Sabt\Category\Policies\CategoryPolicy;
use Sabt\RolePermissions\Models\Permission;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/categoryRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Category');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        DatabaseSeeder::$seeders[] = CategorySeeder::class;
        Gate::policy(Category::class,CategoryPolicy::class);

    }

    public function boot()
    {
        config()->set('Sidebar.items.categories', [
            "icon"  => "i-categories",
            "url"   => route('categories.index'),
            "title" => "دسته بندی ها",
            "permission"=>Permission::MANAGE_CATEGORIES_PERMISSION
        ]);
    }
}
