<?php

namespace Mekad\LaravelThemeCustomizer\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Mekad\LaravelThemeCustomizer\Models\Theme;
use Mekad\LaravelThemeCustomizer\Models\ThemeColor;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepositoryInterface;
use Mekad\LaravelThemeCustomizer\Services\ThemeCustomizerService;

class ThemeMiddleware
{
    protected $themeRepository;

    public function __construct(ThemeRepositoryInterface $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    public function handle($request, Closure $next)
    {
      
        $themeCustomizerService = app(ThemeCustomizerService::class);
      
        $colors = $themeCustomizerService->getActiveThemeColors();
        // dd($colors);
        view()->share('colors', $colors);

        return $next($request);
    }
}