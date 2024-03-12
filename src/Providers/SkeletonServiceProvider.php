<?php

namespace Vendor\LaralvePackageSkeleton\Providers;

use Illuminate\Support\ServiceProvider;
use Vendor\LaralvePackageSkeleton\Facades\SkeletonFacade;

class SkeletonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'laravel-package-skeleton');

        $this->app->singleton('laravel-package-skeleton', function () {
            return new SkeletonFacade();
        });
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/routes.php');
    }
}
