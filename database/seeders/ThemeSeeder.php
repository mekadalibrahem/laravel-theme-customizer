<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        $defaultColors = Config::get('theme-customizer.default_colors');
        $defaultThemes = Config::get('theme-customizer.themes');

        // Insert default themes
        foreach ($defaultThemes as $themeKey => $themeData) {
            $themeId = DB::table('themes')->insertGetId([
                'key' => $themeKey,
                'is_active' => $themeData['is_active'] ?? false,
                'is_global' => $themeData['is_global'] ?? false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert theme colors
            DB::table('theme_colors')->insert([
                'theme_id' => $themeId,
                'primary' => $themeData['colors']['primary'] ?? $defaultColors['primary'],
                'secondary' => $themeData['colors']['secondary'] ?? $defaultColors['secondary'],
                'accent' => $themeData['colors']['accent'] ?? $defaultColors['accent'],
                'warning' => $themeData['colors']['warning'] ?? $defaultColors['warning'],
                'success' => $themeData['colors']['success'] ?? $defaultColors['success'],
                'highlight' => $themeData['colors']['highlight'] ?? $defaultColors['highlight'],
                'dark' => $themeData['colors']['dark'] ?? $defaultColors['dark'],
                'neutral' => $themeData['colors']['neutral'] ?? $defaultColors['neutral'],
                'light' => $themeData['colors']['light'] ?? $defaultColors['light'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
