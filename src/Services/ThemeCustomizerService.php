<?php

namespace Mekad\LaravelThemeCustomizer\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Mekad\LaravelThemeCustomizer\Models\Theme;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeRepository;
use Mekad\LaravelThemeCustomizer\Repositories\ThemeColorRepository;
use Mekad\LaravelThemeCustomizer\Colors\ColorManager;

class ThemeCustomizerService
{
    public function __construct(
        private ThemeRepository $themeRepository,
        private ThemeColorRepository $colorRepository,
        private ColorManager $colorManager
    ) {}

    public function getActiveThemeColors(): ?array
    {
        if (config('theme-customizer.cache')) {
            $theme = config('theme-customizer.theme_mode') === 'admin'
                ? Cache::remember('global_theme', 3600, fn() => $this->themeRepository->getActiveGlobalTheme())
                : (Auth::check() ? $this->themeRepository->getActiveThemeByUserId(Auth::id()) : null);
        } else {
            $theme = config('theme-customizer.theme_mode') === 'admin'
                ? $this->themeRepository->getActiveGlobalTheme()
                : (Auth::check() ? $this->themeRepository->getActiveThemeByUserId(Auth::id()) : null);
        }

        if (!$theme) {
            return null;
        }
        $colors = $this->colorRepository->findByThemeId($theme->id);
        if (!$colors) {
            return null;
        }

        $colorArray = $colors->toArray();
        $defaultColors = config('theme-customizer.default_colors');
        $filteredColors = array_intersect_key($colorArray, $defaultColors);
        // Generate shadow variations if enabled
        if ($this->colorManager->isShadowsEnabled()) {
            foreach ($filteredColors as $colorName => $colorValue) {

                $shadows = $this->colorManager->generateShadows($colorValue);
                foreach ($shadows as $variant => $shadowColor) {
                    $filteredColors[$this->colorManager->formatColorName($colorName, $variant * 10)] = $shadowColor;
                }
            }
        }
        
        return $filteredColors;
    }

    public function updateThemeColors(int $themeId, array $colors): bool
    {
        $theme = $this->themeRepository->find($themeId);
        if (!$theme) {
            return false;
        }

        $this->colorRepository->updateOrCreate($themeId, $colors);
        return true;
    }

    public function getThemeColors(int $themeId): ?array
    {
        $colors = $this->colorRepository->findByThemeId($themeId);
        if (!$colors) {
            return null;
        }

        $colorArray = $colors->toArray();

        // Generate shadow variations if enabled
        if ($this->colorManager->isShadowsEnabled()) {
            foreach ($colorArray as $colorName => $colorValue) {
                if ($colorName !== 'theme_id' && $colorName !== 'id') {
                    $shadows = $this->colorManager->generateShadows($colorValue);
                    foreach ($shadows as $variant => $shadowColor) {
                        $colorArray[$this->colorManager->formatColorName($colorName, $variant)] = $shadowColor;
                    }
                }
            }
        }

        return $colorArray;
    }
}
