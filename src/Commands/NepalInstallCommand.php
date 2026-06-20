<?php

namespace RoshanDhungana\NepalGeography\Commands;

use Illuminate\Console\Command;

class NepalInstallCommand extends Command
{
    protected $signature = 'nepal:install
                            {--fresh : Drop all tables and rebuild database}
                            {--force : Skip confirmation prompt}';

    protected $description = 'Install Nepal geography dataset';

    public function handle(): int
    {
        $this->warn('======================================');
        $this->warn('🇳🇵 Nepal Geography Installation');
        $this->warn('======================================');

        $this->newLine();

        $this->info('This will install:');
        $this->line('  • Countries (Nepal)');
        $this->line('  • Provinces / States');
        $this->line('  • Districts');
        $this->line('  • Municipalities (Local Levels)');

        $this->newLine();

        if ($this->option('fresh')) {
            $this->error('⚠️  WARNING: --fresh will DELETE ALL existing tables!');
        }

        if (! $this->option('force')) {
            if (! $this->confirm('Do you want to continue?')) {
                $this->warn('Installation cancelled.');

                return self::FAILURE;
            }
        }

        $this->newLine();
        $this->info('📦 Installing Nepal Geography Package...');

        /*
        |--------------------------------------------------------------------------
        | Publish JSON Dataset
        |--------------------------------------------------------------------------
        */

        $this->info('Publishing Nepal geography data...');

        $this->call('vendor:publish', [
            '--tag' => 'nepal-geography-data',
            '--force' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Run Migrations
        |--------------------------------------------------------------------------
        */

        if ($this->option('fresh')) {

            $this->info('Running migrate:fresh...');

            $this->call('migrate:fresh', [
                '--force' => true,
            ]);
        } else {

            $this->info('Running migrations...');

            $this->call('migrate', [
                '--force' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Seed Geography Data
        |--------------------------------------------------------------------------
        */

        $this->info('Seeding Nepal geography data...');

        $this->call('db:seed', [
            '--class' => \RoshanDhungana\NepalGeography\Seeders\NepalGeographySeeder::class,
            '--force' => true,
        ]);

        $this->newLine();

        $this->info('✅ Nepal Geography installed successfully!');
        $this->line('You can now use countries, states, districts and municipalities.');

        return self::SUCCESS;
    }
}
