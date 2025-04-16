<?php

namespace Mekad\LaravelThemeCustomizer\Console;

use Illuminate\Console\Command;

class InstallThemeCustomizer extends Command
{
    protected $signature = 'theme-customizer:install';
    protected $description = 'Install the Theme Customizer package';

    public function handle()
    {
        $this->info('Installing Laravel Theme Customizer...');

        // Run migrations
        $this->call('migrate');

        // Run seeder
        $this->call('db:seed', [
            '--class' => \Mekad\LaravelThemeCustomizer\Database\Seeders\ThemeSeeder::class
        ]);

        $this->info('Laravel Theme Customizer installed successfully!');
    }
}
