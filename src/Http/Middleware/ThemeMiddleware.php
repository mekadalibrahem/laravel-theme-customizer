<?php

namespace Mekad\LaravelThemeCustomizer\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use YourVendor\ThemeCustomizer\Repositories\ThemeRepositoryInterface;

class ThemeMiddleware
{
    protected $themeRepository;

    public function __construct(ThemeRepositoryInterface $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $theme = config('theme-customizer.theme_mode') === 'admin'
                ? $this->themeRepository->getGlobalTheme()
                : $this->themeRepository->getByUserId(Auth::id());

            view()->share('theme', $theme ?? config('theme-customizer.default_colors'));
        } else {
            view()->share('theme', config('theme-customizer.default_colors'));
        }

        return $next($request);
    }
}