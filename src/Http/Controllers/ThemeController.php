<?php

namespace Mekad\LaravelThemeCustomizer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepositoryInterface;

/**
 * ThemeController
 *
 * Handles all theme customization related actions including:
 * - Displaying the theme editor
 * - Updating theme settings
 * - Setting active themes
 * - Retrieving theme data
 */
class ThemeController extends Controller
{
    /**
     * Theme repository instance.
     *
     * @var ThemeRepositoryInterface
     */
    protected $themeRepository;

    /**
     * Create a new controller instance.
     *
     * @param ThemeRepositoryInterface $themeRepository
     * @return void
     */
    public function __construct(ThemeRepositoryInterface $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    /**
     * Check if the current user has admin role.
     *
     * @return bool
     */
    protected function isAdmin()
    {
        if (!config('theme-customizer.roles.enabled')) {
            return true;
        }

        return Auth::check() && Auth::user()->hasRole(config('theme-customizer.roles.admin_role'));
    }

    /**
     * Display the theme editor interface.
     *
     * Retrieves themes based on the current theme mode:
     * - Admin mode: Shows global themes
     * - User mode: Shows user-specific themes
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show()
    {
        if (config('theme-customizer.theme_mode') === 'admin' && !$this->isAdmin()) {
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        $themes = config('theme-customizer.theme_mode') === 'admin'
            ? $this->themeRepository->getGlobalThemes()
            : $this->themeRepository->getByUserId(Auth::id());

        $activeTheme = config('theme-customizer.theme_mode') === 'admin'
            ? $this->themeRepository->getActiveGlobalTheme()
            : $this->themeRepository->getActiveThemeByUserId(Auth::id());

        $theme = $activeTheme ?? config('theme-customizer.default_colors');

        return view('laravel-theme-customizer::theme.edit', compact('themes', 'theme'));
    }

    /**
     * Update or create a theme.
     *
     * Validates and processes theme data including:
     * - Color values in hex format
     * - Theme key and name
     * - Global/user-specific theme settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (config('theme-customizer.theme_mode') === 'admin' && !$this->isAdmin()) {
            return redirect()->back()->with('error', 'You do not have permission to update themes.');
        }

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

    /**
     * Set a theme as active.
     *
     * Handles both global and user-specific theme activation:
     * - Admin mode: Sets global active theme
     * - User mode: Sets user's active theme
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setActive(Request $request)
    {
        if (config('theme-customizer.theme_mode') === 'admin' && !$this->isAdmin()) {
            return redirect()->back()->with('error', 'You do not have permission to set active themes.');
        }

        $request->validate([
            'theme_id' => 'required|exists:themes,id',
        ]);

        if (config('theme-customizer.theme_mode') === 'admin') {
            // In admin mode, deactivate all global themes first
            $this->themeRepository->deactivateAllGlobalThemes();
            // Then activate the selected global theme
            $this->themeRepository->setActiveGlobalTheme($request->theme_id);
        } else {
            // In user mode, deactivate all user's themes first
            $this->themeRepository->deactivateAllUserThemes(Auth::id());
            // Then activate the selected theme for the user
            $this->themeRepository->setActiveTheme(Auth::id(), $request->theme_id);
        }

        return redirect()->back()->with('success', 'Active theme set successfully!');
    }

    /**
     * Retrieve theme data by ID.
     *
     * Returns theme data in JSON format for AJAX requests.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTheme(Request $request)
    {
        if (config('theme-customizer.theme_mode') === 'admin' && !$this->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'theme_id' => 'required|exists:themes,id',
        ]);

        $theme = $this->themeRepository->find($request->theme_id);

        return response()->json($theme);
    }

    /**
     * Delete a theme.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        if (config('theme-customizer.theme_mode') === 'admin' && !$this->isAdmin()) {
            return redirect()->back()->with('error', 'You do not have permission to delete themes.');
        }

        $request->validate([
            'theme_id' => 'required|exists:themes,id',
        ]);

        $theme = $this->themeRepository->find($request->theme_id);

        // Prevent deletion of active theme
        if ($theme->is_active) {
            return redirect()->back()->with('error', 'Cannot delete the active theme. Please set another theme as active first.');
        }

        $this->themeRepository->delete($request->theme_id);

        return redirect()->back()->with('success', 'Theme deleted successfully!');
    }
}
