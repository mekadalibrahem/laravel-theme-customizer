<?php

namespace Mekad\LaravelThemeCustomizer\Services;

use Mekad\LaravelThemeCustomizer\Contracts\ThemeFramework;

class TailwindThemeFramework implements ThemeFramework
{
    public function getStyles(array $colors): string
    {
        return <<<CSS
:root {
    --primary-color: {$colors['primary_color']};
    --secondary-color: {$colors['secondary_color']};
    --background-color: {$colors['background_color']};
    --text-color: {$colors['text_color']};
}

.bg-primary {
    background-color: var(--primary-color);
}

.text-primary {
    color: var(--primary-color);
}

.bg-secondary {
    background-color: var(--secondary-color);
}

.bg-background {
    background-color: var(--background-color);
}

.text-color {
    color: var(--text-color);
}
CSS;
    }
}