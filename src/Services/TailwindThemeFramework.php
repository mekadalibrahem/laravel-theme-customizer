<?php

namespace Mekad\LaravelThemeCustomizer\Services;

use Mekad\LaravelThemeCustomizer\Contracts\ThemeFramework;


class TailwindThemeFramework implements ThemeFramework
{
    public function __construct(
       
    ) {}

    public function getStyles(array $colors): string
    {
        // dd($colors);
        $css = ":root {\n";

        // Base colors
        foreach ($colors as $name => $value) {
          
                $css .= "    --{$name}: {$value};\n";
           
        }

        $css .= "}\n\n";

        // Generate utility classes for base colors
        foreach ($colors as $name => $value) {
            if (!str_contains($name, '-')) { // Only base colors
                $css .= ".bg-{$name} { background-color: var(--{$name}); }\n";
                $css .= ".text-{$name} { color: var(--{$name}); }\n";
                $css .= ".border-{$name} { border-color: var(--{$name}); }\n\n";
            }
        }

        // Generate utility classes for shadow variations
        foreach ($colors as $name => $value) {
            if (str_contains($name, '-')) { // Only shadow variations
                $css .= ".bg-{$name} { background-color: var(--{$name}); }\n";
                $css .= ".text-{$name} { color: var(--{$name}); }\n";
                $css .= ".border-{$name} { border-color: var(--{$name}); }\n\n";
            }
        }

        return $css;
    }
}
