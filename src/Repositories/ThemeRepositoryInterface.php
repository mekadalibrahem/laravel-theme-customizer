<?php

namespace Mekad\LaravelThemeCustomizer\Repositories;

interface ThemeRepositoryInterface
{
    public function getGlobalTheme();
    public function getGlobalThemes();
    public function getActiveGlobalTheme();
    public function getByUserId($userId);
    public function getActiveThemeByUserId($userId);
    public function updateOrCreate($userId, array $data, $isGlobal = false);
    public function find($themeId);
    public function setActiveTheme($userId, $themeId);
    public function setActiveGlobalTheme($themeId);
}