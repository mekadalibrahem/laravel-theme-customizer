<?php

namespace YourVendor\ThemeCustomizer\Factories;

use InvalidArgumentException;
use YourVendor\ThemeCustomizer\Services\BootstrapThemeFramework;
use YourVendor\ThemeCustomizer\Services\TailwindThemeFramework;

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