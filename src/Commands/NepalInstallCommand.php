<?php

namespace RoshanDhungana\NepalGeography\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use RoshanDhungana\NepalGeography\NepalGeographyServiceProvider;
use RoshanDhungana\NepalGeography\Seeders\NepalGeographySeeder;

class NepalInstallCommand extends Command
{
    protected $signature = 'nepal:install {--fresh : Drop tables and re-run migrations}';

    protected $description = 'Install Nepal geography dataset (migrate + seed)';

    public function handle()
    {
        $this->info('📦 Installing Nepal Geography Package...');

        // Step 1: Publish migrations
        $this->info('Publishing migrations...');

        Artisan::call('vendor:publish', [
            '--provider' => NepalGeographyServiceProvider::class,
            '--tag' => 'nepal-geography-migrations',
            '--force' => true,
        ]);

        $this->line(Artisan::output());

        // Step 2: Run migrations
        $this->info('Running migrations...');

        if ($this->option('fresh')) {
            $this->call('migrate:fresh', [
                '--force' => true,
            ]);
        } else {
            $this->call('migrate', [
                '--force' => true,
            ]);
        }

        // Step 3: Run seeder
        $this->info('Seeding data...');

        $this->call('db:seed', [
            '--class' => NepalGeographySeeder::class,
            '--force' => true,
        ]);

        $this->info('✅ Nepal geography installed successfully!');
    }
}