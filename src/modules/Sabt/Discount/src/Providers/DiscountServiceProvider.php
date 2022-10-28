<?php
namespace Sabt\Discount\Providers;

use Sabt\Discount\Models\Discount;
use Sabt\Discount\Policies\DiscountPolicy;
use Sabt\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    public $namespace = "Sabt\Discount\Http\Controllers";
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/discount_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Discounts');
        dd(65);
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang/");
        Gate::policy(Discount::class, DiscountPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.discounts', ["icon" => "i-discounts",
            "title" => "تخفیف ها",
            "url" => route('discounts.index'),
            "permission" => Permission::PERMISSION_MANAGE_DISCOUNT
        ]);
    }
}
