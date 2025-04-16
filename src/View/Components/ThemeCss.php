<?php

namespace Mekad\LaravelThemeCustomizer\View\Components;

use Illuminate\View\Component; // Correct namespace
use Mekad\LaravelThemeCustomizer\Factories\ThemeFrameworkFactory;

class ThemeCss extends Component
{
    public $framework;

    public function __construct()
    {
     
        $framework_name = config('theme-customizer.framework', 'tailwind');
        $this->framework = ThemeFrameworkFactory::create($framework_name);
    }

    public function render()
    {
        return view('laravel-theme-customizer::components.theme-css');
    }
}
