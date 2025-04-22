<?php

namespace Mekad\LaravelThemeCustomizer\View\Components;

use Illuminate\View\Component;
use Mekad\LaravelThemeCustomizer\Services\ThemeCustomizerService;
use Illuminate\Support\Facades\Config;

class ThemeCustomizer extends Component
{
    public function __construct(
        private ThemeCustomizerService $themeService
    ) {}

    public function render()
    {
        $colors = $this->themeService->getActiveThemeColors();
        $defaultColors = Config::get('theme-customizer.default_colors');

        return view('laravel-theme-customizer::components.theme-customizer', [
            'colors' => $colors ?? $defaultColors
        ]);
    }
}
