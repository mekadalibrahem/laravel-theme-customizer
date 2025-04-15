<?php

namespace Mekad\LaravelThemeCustomizer\Contracts;

interface ThemeFramework
{
    public function getStyles(array $colors): string;
}