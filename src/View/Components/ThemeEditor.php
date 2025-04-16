<?php

namespace Mekad\LaravelThemeCustomizer\View\Components;

use Illuminate\View\Component;

class ThemeEditor extends Component
{
   

    public function __construct()
    {
     
      
    }

    public function render()
    {
        return view('laravel-theme-customizer::components.theme-editor');
    }
}
