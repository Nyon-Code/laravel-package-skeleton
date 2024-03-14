<?php

namespace Vendor\LaralvePackageSkeleton\Providers;

use Illuminate\Support\ServiceProvider;
use Vendor\LaralvePackageSkeleton\Facades\SkeletonFacade;

class SkeletonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            path: __DIR__.'/../../config/config.php',
            key:'laravel-package-skeleton'
        );

        $this->app->singleton(
            abstract: 'laravel-package-skeleton',
            concrete: function () {
                return new SkeletonFacade();
            }
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(paths: __DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(path: __DIR__.'/../../routes/routes.php');
        $this->loadTranslationsFrom(path: __DIR__.'/../../lang', namespace: 'laravel-package-skeleton');
    }
}
