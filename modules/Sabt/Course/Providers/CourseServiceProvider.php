<?php


namespace Sabt\Course\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Sabt\Course\Models\Course;
use Sabt\Course\Policies\CoursePolicy;
use Sabt\RolePermissions\Models\Permission;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/CourseRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Course');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        Gate::policy(Course::class, CoursePolicy::class);

    }

    public function boot()
    {
        config()->set('Sidebar.items.courses', [
            "icon"  => "i-courses",
            "url"   => route('courses.index'),
            "title" => "دوره ها",
        ]);
    }
}
