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
            'key' => 'required|string|max:255|regex:/^[a-zA-Z0-9_-]+$/',
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'light_primary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'light_secondary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'accent_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_light' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_dark' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'dark_background' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $data = [
            'key' => $request->key,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'light_primary' => $request->light_primary,
            'light_secondary' => $request->light_secondary,
            'accent_color' => $request->accent_color,
            'text_light' => $request->text_light,
            'text_dark' => $request->text_dark,
            'dark_background' => $request->dark_background,
        ];

        if (config('theme-customizer.theme_mode') === 'admin') {
            $this->themeRepository->updateOrCreate(null, $data, true);
        } else {
            $this->themeRepository->updateOrCreate(Auth::id(), $data);
        }

        return redirect()->back()->with('success', 'Theme updated successfully!');
    }
}