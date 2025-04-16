<?php

return [
    'framework' => env('THEME_FRAMEWORK', 'tailwind'), // tailwind or bootstrap
    'theme_mode' => env('THEME_MODE', 'user'), // admin or user
    'admin_role' => 'admin', // Role name for admin users
    'default_colors' => [
        'key' => 'default_theme',
        'primary_color' => '#3490dc',
        'secondary_color' => '#ffed4a',
        'light_primary' => '#6cb2eb',
        'light_secondary' => '#fff5a1',
        'accent_color' => '#e3342f',
        'text_light' => '#ffffff',
        'text_dark' => '#1a202c',
        'dark_background' => '#2d3748',
    ],
    'cache' => false,
];