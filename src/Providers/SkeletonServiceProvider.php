<?php

namespace Vendor\LaravelPackageSkeleton\Providers;

use Composer\InstalledVersions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\AboutCommand;
use Vendor\LaravelPackageSkeleton\Commands\SkeletonCommand;
use Vendor\LaravelPackageSkeleton\Facades\SkeletonFacade;

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
        $this->loadJsonTranslationsFrom(path: __DIR__.'/../../lang');
        $this->loadViewsFrom(path: __DIR__.'/../../resources/views', namespace: 'laravel-package-skeleton');

        /**
         * Return package information in about
         *
         * ---
         * php artisan about
         */
        if (class_exists(AboutCommand::class) && class_exists(InstalledVersions::class)) {
            AboutCommand::add('Laravel_Package_Skeleton', [
                'Version' => InstalledVersions::getPrettyVersion('nyoncode/laravel-package-skeleton'),
            ]);
        }

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
         * ---
         * php artisan vendor:publish --tag=skeleton_config
         */
        $this->publishes([
            __DIR__.'/../../database/migrations' => config_path(path: 'package_name.php')
        ], groups: 'skeleton_config');

        /**
         * Publish database migration
         *
         * ---
         * php artisan vendor:publish --tag=skeleton_migrations
         */
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path(path: 'migrations')
        ], groups: 'skeleton_migrations');

        /**
         * Publish view files
         *
         * ---
         * php artisan vendor:publish --tag=skeleton_views
         */
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path(path: 'views/vendor/package_name'),
        ], groups: 'skeleton_views');

    }
}
