<?php

namespace Mekad\LaravelThemeCustomizer\Console;

use Illuminate\Console\Command;

class InstallThemeCustomizer extends Command
{
    protected $signature = 'theme-customizer:install';
    protected $description = 'Install the Theme Customizer package';

    public function handle()
    {
        $this->info('Installing Theme Customizer...');

        $this->call('vendor:publish', [
            '--provider' => 'YourVendor\ThemeCustomizer\ThemeCustomizerServiceProvider',
            '--tag' => 'config',
        ]);

        $this->call('vendor:publish', [
            '--provider' => 'YourVendor\ThemeCustomizer\ThemeCustomizerServiceProvider',
            '--tag' => 'migrations',
        ]);

        $this->call('migrate');

        $this->info('Theme Customizer installed successfully!');
    }
}