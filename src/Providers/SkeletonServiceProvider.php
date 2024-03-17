<?php

namespace Vendor\LaralvePackageSkeleton\Providers;

use Illuminate\Support\ServiceProvider;
use Vendor\LaralvePackageSkeleton\Commands\SkeletonCommand;
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

        /**
         * Determine if the application is running in the console.
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                SkeletonCommand::class,
            ]);

        }

        /**
         * Publish config file
         *
         * php artisan vendor:publish --tag=skeleton_config
         */
        $this->publishes([
            __DIR__.'/../../database/migrations' => config_path('package_name.php')
        ], 'skeleton_config');

        /**
         * Publish database migration
         *
         * php artisan vendor:publish --tag=skeleton_migrations
         */
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations')
        ], 'skeleton_migrations');

        /**
         * Publish view files
         *
         * php artisan vendor:publish --tag=skeleton_views
         */
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/package_name'),
        ], 'skeleton_views');

    }
}
