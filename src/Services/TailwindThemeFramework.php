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
    --light-primary: {$colors['light_primary']};
    --light-secondary: {$colors['light_secondary']};
    --accent-color: {$colors['accent_color']};
    --text-light: {$colors['text_light']};
    --text-dark: {$colors['text_dark']};
    --dark-background: {$colors['dark_background']};
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

.text-secondary {
    color: var(--secondary-color);
}

.bg-light-primary {
    background-color: var(--light-primary);
}

.bg-light-secondary {
    background-color: var(--light-secondary);
}

.bg-accent {
    background-color: var(--accent-color);
}

.text-accent {
    color: var(--accent-color);
}

.bg-dark-background {
    background-color: var(--dark-background);
}

.text-light {
    color: var(--text-light);
}

.text-dark {
    color: var(--text-dark);
}
CSS;
    }
}