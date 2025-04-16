<?php

namespace Mekad\LaravelThemeCustomizer\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Mekad\LaravelThemeCustomizer\Models\Theme;

class ThemeEditor extends Component
{
   

    public function __construct(
        public  $themes = null,
    )
    {
        $this->themes = $themes ?? Theme::where('user_id' , Auth::id())
        ->orWhere('is_global' , 1)
        ->get();
      
    }

    public function render()
    {
        return view('laravel-theme-customizer::components.theme-editor');
    }
}
