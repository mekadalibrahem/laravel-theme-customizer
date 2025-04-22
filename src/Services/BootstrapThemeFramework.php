<?php

namespace Mekad\LaravelThemeCustomizer\Services;

use Mekad\LaravelThemeCustomizer\Contracts\ThemeFramework;


class BootstrapThemeFramework implements ThemeFramework
{
    public function __construct(
      
    ) {}

    public function getStyles(array $colors): string
    {
        $css = ":root {\n";

        // Base colors
        foreach ($colors as $name => $value) {
            if (!str_contains($name, '-')) { // Only base colors
                $css .= "    --bs-{$name}: {$value};\n";
            }
        }

        $css .= "}\n\n";

        // Generate utility classes for base colors
        foreach ($colors as $name => $value) {
            if (!str_contains($name, '-')) { // Only base colors
                $css .= ".btn-{$name} {\n";
                $css .= "    background-color: var(--bs-{$name});\n";
                $css .= "    border-color: var(--bs-{$name});\n";
                $css .= "    color: var(--bs-text-light);\n";
                $css .= "}\n\n";

                $css .= ".btn-{$name}:hover {\n";
                $css .= "    background-color: var(--bs-{$name}-dark);\n";
                $css .= "    border-color: var(--bs-{$name}-dark);\n";
                $css .= "}\n\n";

                $css .= ".bg-{$name} { background-color: var(--bs-{$name}); }\n";
                $css .= ".text-{$name} { color: var(--bs-{$name}); }\n";
                $css .= ".border-{$name} { border-color: var(--bs-{$name}); }\n\n";
            }
        }

        // Generate utility classes for shadow variations
        foreach ($colors as $name => $value) {
            if (str_contains($name, '-')) { // Only shadow variations
                $baseName = explode('-', $name)[0];
                $variant = explode('-', $name)[1];

                $css .= ".btn-{$baseName}-{$variant} {\n";
                $css .= "    background-color: var(--bs-{$name});\n";
                $css .= "    border-color: var(--bs-{$name});\n";
                $css .= "}\n\n";

                $css .= ".bg-{$name} { background-color: var(--bs-{$name}); }\n";
                $css .= ".text-{$name} { color: var(--bs-{$name}); }\n";
                $css .= ".border-{$name} { border-color: var(--bs-{$name}); }\n\n";
            }
        }

        return $css;
    }
}
