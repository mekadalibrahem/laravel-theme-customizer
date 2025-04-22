<?php

namespace Mekad\LaravelThemeCustomizer\Repositories;

use Mekad\LaravelThemeCustomizer\Models\ThemeColor;

class ThemeColorRepository
{
    public function create(array $data): ThemeColor
    {
        return ThemeColor::create($data);
    }

    public function update(ThemeColor $themeColor, array $data): bool
    {
        return $themeColor->update($data);
    }

    public function delete(ThemeColor $themeColor): bool
    {
        return $themeColor->delete();
    }

    public function findByThemeId(int $themeId): ?ThemeColor
    {
        return ThemeColor::where('theme_id', $themeId)->first();
    }

    public function updateOrCreate(int $themeId, array $data): ThemeColor
    {
        return ThemeColor::updateOrCreate(
            ['theme_id' => $themeId],
            $data
        );
    }
}
