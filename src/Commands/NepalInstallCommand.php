<?php

namespace RoshanDhungana\NepalGeography\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class NepalInstallCommand extends Command
{
    protected $signature = 'nepal:install 
        {--fresh : Drop all tables and rebuild database}
        {--force : Skip confirmation prompt}';

    protected $description = 'Install Nepal geography dataset (fresh migrate + seed)';

    public function handle()
    {
        $this->warn('======================================');
        $this->warn('⚠️  Nepal Geography Installation');
        $this->warn('======================================');

        $this->line('');
        $this->info('This will install:');
        $this->line('  • Countries (Nepal)');
        $this->line('  • Provinces / States');
        $this->line('  • Districts');
        $this->line('  • Municipalities (Local levels)');
        $this->line('');

        if ($this->option('fresh')) {
            $this->error('⚠️  WARNING: --fresh will DELETE ALL existing tables!');
        }

        if (! $this->option('force')) {
            if (! $this->confirm('Do you want to continue?')) {
                $this->warn('Installation cancelled.');
                return self::FAILURE;
            }
        }

        $this->info('📦 Installing Nepal Geography Package...');

        // Run migrations
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

        // Seed data
        $this->info('Seeding Nepal geography data...');
        $this->call('db:seed', [
            '--class' => \RoshanDhungana\NepalGeography\Seeders\NepalGeographySeeder::class,
            '--force' => true,
        ]);

        $this->newLine();
        $this->info('✅ Nepal geography installed successfully!');
        $this->line('You can now use countries, states, districts, and municipalities.');
    }
}