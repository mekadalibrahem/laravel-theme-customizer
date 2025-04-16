<?php

namespace Mekad\LaravelThemeCustomizer\Repositories;

/**
 * ThemeRepositoryInterface
 *
 * Defines the contract for theme data management including:
 * - Global theme operations
 * - User-specific theme operations
 * - Theme activation/deactivation
 * - Theme creation and updates
 */
interface ThemeRepositoryInterface
{
    /**
     * Get the global theme.
     *
     * @return \Mekad\LaravelThemeCustomizer\Models\Theme|null
     */
    public function getGlobalTheme();

    /**
     * Get all global themes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGlobalThemes();

    /**
     * Get the active global theme.
     *
     * @return \Mekad\LaravelThemeCustomizer\Models\Theme|null
     */
    public function getActiveGlobalTheme();

    /**
     * Get themes for a specific user.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId($userId);

    /**
     * Get the active theme for a specific user.
     *
     * @param int $userId
     * @return \Mekad\LaravelThemeCustomizer\Models\Theme|null
     */
    public function getActiveThemeByUserId($userId);

    /**
     * Update or create a theme.
     *
     * @param int|null $userId
     * @param array $data
     * @param bool $isGlobal
     * @return \Mekad\LaravelThemeCustomizer\Models\Theme
     */
    public function updateOrCreate($userId, array $data, $isGlobal = false);

    /**
     * Find a theme by ID.
     *
     * @param int $themeId
     * @return \Mekad\LaravelThemeCustomizer\Models\Theme
     */
    public function find($themeId);

    /**
     * Set a theme as active for a specific user.
     *
     * @param int $userId
     * @param int $themeId
     * @return void
     */
    public function setActiveTheme($userId, $themeId);

    /**
     * Set a global theme as active.
     *
     * @param int $themeId
     * @return void
     */
    public function setActiveGlobalTheme($themeId);

    /**
     * Deactivate all global themes.
     *
     * @return void
     */
    public function deactivateAllGlobalThemes();

    /**
     * Deactivate all themes for a specific user.
     *
     * @param int $userId
     * @return void
     */
    public function deactivateAllUserThemes($userId);

    /**
     * Delete a theme.
     *
     * @param int $themeId
     * @return void
     */
    public function delete($themeId);
}
