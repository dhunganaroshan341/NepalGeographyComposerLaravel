<?php

namespace RoshanDhungana\NepalGeography;

use Illuminate\Support\ServiceProvider;
use RoshanDhungana\NepalGeography\Commands\NepalInstallCommand;

class NepalGeographyServiceProvider extends ServiceProvider
{
    /**
     * Register package services.
     */
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                NepalInstallCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap package services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Load Package Migrations
        |--------------------------------------------------------------------------
        |
        | Laravel will automatically discover and run these migrations.
        |
        */

        $this->loadMigrationsFrom(
            __DIR__ . '/../database/migrations'
        );

        /*
        |--------------------------------------------------------------------------
        | Publish Geography Dataset
        |--------------------------------------------------------------------------
        |
        | Copies JSON files into:
        | storage/app/nepal-geography
        |
        */

        $this->publishes([
            __DIR__ . '/../database/data' => storage_path('app/nepal-geography'),
        ], 'nepal-geography-data');
    }
}
