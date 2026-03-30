<?php
namespace RoshanDhungana\NepalGeography;

use Illuminate\Support\ServiceProvider;
use RoshanDhungana\NepalGeography\Commands\NepalInstallCommand;

class NepalGeographyServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                NepalInstallCommand::class,
            ]);
        }
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'nepal-geography-migrations');

        $this->publishes([
            __DIR__.'/../database/seeders/' => database_path('seeders'),
        ], 'nepal-geography-seeders');

        $this->publishes([
            __DIR__.'/../database/data/' => storage_path('app/nepal-geography'),
        ], 'nepal-geography-data');
    }
}