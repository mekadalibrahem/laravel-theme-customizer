<?php

namespace Mekad\LaravelThemeCustomizer;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Mekad\LaravelThemeCustomizer\Console\InstallThemeCustomizer;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepository;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepositoryInterface;
use Mekad\LaravelThemeCustomizer\Colors\ColorManager;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeColorRepository;
use Mekad\LaravelThemeCustomizer\Services\ThemeCustomizerService;

class ThemeCustomizerServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigrations();
        $this->publishViews();
        $this->publishAssets();
        $this->loadRoutes();
        $this->loadViews();
        $this->registerCommands();

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

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

        $this->app->singleton(ColorManager::class, function ($app) {
            return new ColorManager();
        });
    $this->app->singleton(ThemeCustomizerService::class, function ($app) {
        return new ThemeCustomizerService(
            $app->make(ThemeRepository::class),
            $app->make(ThemeColorRepository::class),
            $app->make(ColorManager::class)
        );
    });
    }

    private function publishConfig()
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/theme-customizer.php' => config_path('theme-customizer.php'),
        ], 'config');
    }

    private function publishMigrations()
    {
        // Publish migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    private function publishViews()
    {
        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/laravel-theme-customizer'),
        ], 'views');
    }

    private function publishAssets()
    {
        // Publish assets
        // This method is empty as the original implementation didn't include a publishAssets method
    }

    private function loadRoutes()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    private function loadViews()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-theme-customizer');
    }

    private function publishSeeder()
    {
        $this->publishes([__DIR__ . '/../database/seeders/' => database_path('seeders'), 'seeders']);
    }

    private function registerCommands()
    {
        // Register console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallThemeCustomizer::class,
            ]);
        }
    }
}
