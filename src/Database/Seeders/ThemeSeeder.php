<?php

namespace Mekad\LaravelThemeCustomizer\Database\Seeders;

use Illuminate\Database\Seeder;
use Mekad\LaravelThemeCustomizer\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create active global theme
        Theme::create([
            'key' => 'dark_blue_green',
            'is_global' => true,
            'is_active' => true,
            'primary_color' => '#1a3a6c',
            'secondary_color' => '#1e4d45',
            'light_primary' => '#2c5eaa',
            'light_secondary' => '#2a6b5f',
            'accent_color' => '#ffc107',
            'text_light' => '#f8f9fa',
            'text_dark' => '#343a40',
            'dark_background' => '#1a1a24',
        ]);

        // Create inactive global theme
        Theme::create([
            'key' => 'light_blue_green',
            'is_global' => true,
            'is_active' => false,
            'primary_color' => '#3490dc',
            'secondary_color' => '#38a169',
            'light_primary' => '#6cb2eb',
            'light_secondary' => '#68d391',
            'accent_color' => '#f6ad55',
            'text_light' => '#ffffff',
            'text_dark' => '#1a202c',
            'dark_background' => '#2d3748',
        ]);

        // Create another inactive global theme
        Theme::create([
            'key' => 'purple_teal',
            'is_global' => true,
            'is_active' => false,
            'primary_color' => '#6b46c1',
            'secondary_color' => '#319795',
            'light_primary' => '#9f7aea',
            'light_secondary' => '#4fd1c5',
            'accent_color' => '#f687b3',
            'text_light' => '#ffffff',
            'text_dark' => '#1a202c',
            'dark_background' => '#2d3748',
        ]);
    }
}
