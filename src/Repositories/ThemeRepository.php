<?php

namespace Mekad\LaravelThemeCustomizer\Repositories;

use Mekad\LaravelThemeCustomizer\Models\Theme;

class ThemeRepository implements ThemeRepositoryInterface
{
    public function getGlobalTheme()
    {
        return Theme::where('is_global', true)->first();
    }

    public function getGlobalThemes()
    {
        return Theme::where('is_global', true)->get();
    }

    public function getActiveGlobalTheme()
    {
        return Theme::where('is_global', true)->where('is_active', true)->first();
    }

    public function getByUserId($userId)
    {
        return Theme::where('user_id', $userId)->get();
    }

    public function getActiveThemeByUserId($userId)
    {
        return Theme::where('user_id', $userId)->where('is_active', true)->first();
    }

    public function updateOrCreate($userId, array $data, $isGlobal = false)
    {
        return Theme::updateOrCreate(
            ['user_id' => $userId, 'key' => $data['key'], 'is_global' => $isGlobal],
            array_merge($data, ['is_global' => $isGlobal])
        );
    }

    public function find($themeId)
    {
        return Theme::findOrFail($themeId);
    }

    public function setActiveTheme($userId, $themeId)
    {
        Theme::where('user_id', $userId)->update(['is_active' => false]);
        Theme::where('id', $themeId)->update(['is_active' => true]);
    }

    public function setActiveGlobalTheme($themeId)
    {
        // Deactivate all global themes
        Theme::where('is_global', true)->update(['is_active' => false]);

        // Activate the specified theme
        return Theme::where('id', $themeId)
            ->where('is_global', true)
            ->update(['is_active' => true]);
    }

    /**
     * Deactivate all global themes.
     *
     * @return void
     */
    public function deactivateAllGlobalThemes()
    {
        Theme::where('is_global', true)->update(['is_active' => false]);
    }

    /**
     * Deactivate all themes for a specific user.
     *
     * @param int $userId
     * @return void
     */
    public function deactivateAllUserThemes($userId)
    {
        Theme::where('user_id', $userId)->update(['is_active' => false]);
    }

    /**
     * Delete a theme.
     *
     * @param int $themeId
     * @return bool
     */
    public function delete($themeId)
    {
        return Theme::where('id', $themeId)->delete();
    }
}
