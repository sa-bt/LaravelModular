<?php


namespace Sabt\Course\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Season;
use Sabt\Course\Policies\CoursePolicy;
use Sabt\Course\Policies\SeaPolicy;
use Sabt\Course\Policies\SeasonPolicy;
use Sabt\RolePermissions\Models\Permission;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Course');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        Gate::policy(Season::class, SeaPolicy::class);
        Gate::policy(Course::class, CoursePolicy::class);

    }

    public function boot()
    {

        Gate::policy(Season::class, SeasonPolicy::class);
        Gate::policy(Course::class, CoursePolicy::class);
        config()->set('Sidebar.items.courses', [
            "icon"  => "i-courses",
            "url"   => route('courses.index'),
            "title" => "دوره ها",
            "permission"=>Permission::MANAGE_COURSES_PERMISSION
        ]);
    }
}
