<?php

namespace Mekad\LaravelThemeCustomizer\Services;

use Mekad\LaravelThemeCustomizer\Contracts\ThemeFramework;

class BootstrapThemeFramework implements ThemeFramework
{
    public function getStyles(array $colors): string
    {
        return <<<CSS
:root {
    --bs-primary: {$colors['primary_color']};
    --bs-secondary: {$colors['secondary_color']};
    --bs-light-primary: {$colors['light_primary']};
    --bs-light-secondary: {$colors['light_secondary']};
    --bs-accent: {$colors['accent_color']};
    --bs-text-light: {$colors['text_light']};
    --bs-text-dark: {$colors['text_dark']};
    --bs-dark-background: {$colors['dark_background']};
}

.btn-primary {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
    color: var(--bs-text-light);
}

.btn-primary:hover {
    background-color: darken(var(--bs-primary), 10%);
    border-color: darken(var(--bs-primary), 10%);
}

.btn-secondary {
    background-color: var(--bs-secondary);
    border-color: var(--bs-secondary);
    color: var(--bs-text-dark);
}

.btn-secondary:hover {
    background-color: darken(var(--bs-secondary), 10%);
    border-color: darken(var(--bs-secondary), 10%);
}

.bg-light-primary {
    background-color: var(--bs-light-primary);
}

.bg-light-secondary {
    background-color: var(--bs-light-secondary);
}

.bg-accent {
    background-color: var(--bs-accent);
}

.bg-dark-background {
    background-color: var(--bs-dark-background);
}

.text-light {
    color: var(--bs-text-light);
}

.text-dark {
    color: var(--bs-text-dark);
}
CSS;
    }
}