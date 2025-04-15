<?php

namespace Mekad\LaravelThemeCustomizer;

use Mekad\LaravelThemeCustomizer\Console\InstallThemeCustomizer;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepository;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepositoryInterface;

class ThemeCustomizerServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/theme-customizer.php' => config_path('theme-customizer.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                './views' => resource_path('views/vendor/theme-customizer'),
            ], 'views');

            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

            $this->loadViewsFrom(__DIR__ . '/views', 'theme-customizer');

            $this->app['router']->aliasMiddleware('theme', \Mekad\LaravelThemeCustomizer\Http\Middleware\ThemeMiddleware::class);

            if ($this->app->runningInConsole()) {
                $this->commands([
                    InstallThemeCustomizer::class,
                ]);
            }
        }
    }
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/theme-customizer.php', 'theme-customizer');

        $this->app->bind(ThemeRepositoryInterface::class, ThemeRepository::class);
    }
}
