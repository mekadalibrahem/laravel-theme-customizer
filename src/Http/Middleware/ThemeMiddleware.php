<?php

namespace Mekad\LaravelThemeCustomizer\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepositoryInterface;

class ThemeMiddleware
{
    protected $themeRepository;

    public function __construct(ThemeRepositoryInterface $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    public function handle($request, Closure $next)
    {
        if (config('theme-customizer.cache') == true) {

            $theme = config('theme-customizer.theme_mode') === 'admin'
                ? Cache::remember('global_theme', 3600, fn() => $this->themeRepository->getGlobalTheme())
                : (Auth::check() ? $this->themeRepository->getByUserId(Auth::id()) : null);
        } else {
            $theme = config('theme-customizer.theme_mode') === 'admin'
                ? $this->themeRepository->getGlobalTheme()
                : $this->themeRepository->getByUserId(Auth::id());
        }
        $themeData = $theme ? $theme->attributesToArray() : config('theme-customizer.default_colors');
        view()->share('theme', $themeData);





        return $next($request);
    }
}
