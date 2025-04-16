<?php

namespace Mekad\LaravelThemeCustomizer;

use Illuminate\Support\Facades\Blade;
use Mekad\LaravelThemeCustomizer\Console\InstallThemeCustomizer;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepository;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepositoryInterface;

class ThemeCustomizerServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/theme-customizer.php' => config_path('theme-customizer.php'),
        ], 'config');

        // Publish migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/laravel-theme-customizer'),
        ], 'views');

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-theme-customizer');

        // Register Blade components
        Blade::componentNamespace('Mekad\\LaravelThemeCustomizer\\View\\Components', 'LaravelThemeCustomizer');
        // Register middleware
        $this->app['router']->aliasMiddleware('theme', \Mekad\LaravelThemeCustomizer\Http\Middleware\ThemeMiddleware::class);

        // Register console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallThemeCustomizer::class,
            ]);
        }
    }

    public function register()
    {
        // Merge configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/theme-customizer.php', 'theme-customizer');

        // Bind repository interface to implementation
        $this->app->bind(ThemeRepositoryInterface::class, ThemeRepository::class);
    }
}