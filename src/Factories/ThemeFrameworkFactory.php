<?php

namespace Mekad\LaravelThemeCustomizer\Factories;

use InvalidArgumentException;
use Mekad\LaravelThemeCustomizer\Services\BootstrapThemeFramework;
use Mekad\LaravelThemeCustomizer\Services\TailwindThemeFramework;

class ThemeFrameworkFactory
{
    public static function create(string $framework)
    {
        switch (strtolower($framework)) {
            case 'tailwind':
                return new TailwindThemeFramework();
            case 'bootstrap':
                return new BootstrapThemeFramework();
            default:
                throw new InvalidArgumentException("Unsupported framework: {$framework}");
        }
    }
}