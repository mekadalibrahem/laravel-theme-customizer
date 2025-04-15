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
    --bs-body-bg: {$colors['background_color']};
    --bs-body-color: {$colors['text_color']};
}

.btn-primary {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}

.btn-primary:hover {
    background-color: darken(var(--bs-primary), 10%);
    border-color: darken(var(--bs-primary), 10%);
}

.bg-body {
    background-color: var(--bs-body-bg);
}

.text-body {
    color: var(--bs-body-color);
}
CSS;
    }
}