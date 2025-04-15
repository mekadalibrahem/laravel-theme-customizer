<?php

namespace Mekad\LaravelThemeCustomizer\Repositories;

interface ThemeRepositoryInterface
{
    public function getByUserId($userId);

    public function getGlobalTheme();

    public function updateOrCreate($userId, array $data, bool $isGlobal = false);
}