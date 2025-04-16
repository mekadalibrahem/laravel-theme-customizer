<?php

namespace Mekad\LaravelThemeCustomizer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepositoryInterface;

class ThemeController extends Controller
{
    protected $themeRepository;

    public function __construct(ThemeRepositoryInterface $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    public function show()
    {
     

        $theme = config('theme-customizer.theme_mode') === 'admin'
            ? $this->themeRepository->getGlobalTheme()
            : $this->themeRepository->getByUserId(Auth::id());

        $theme = $theme ?? config('theme-customizer.default_colors');

        return view('laravel-theme-customizer::theme.edit', compact('theme'));
    }

    public function update(Request $request)
    {
       

        $request->validate([
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $data = [
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'background_color' => $request->background_color,
            'text_color' => $request->text_color,
        ];

        if (config('theme-customizer.theme_mode') === 'admin') {
            $this->themeRepository->updateOrCreate(null, $data, true);
        } else {
            $this->themeRepository->updateOrCreate(Auth::id(), $data);
        }

        return redirect()->back()->with('success', 'Theme updated successfully!');
    }
}