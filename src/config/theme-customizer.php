<?php

return [
    'framework' => env('THEME_FRAMEWORK', 'tailwind'), // tailwind or bootstrap
    'theme_mode' => env('THEME_MODE', 'user'), // admin or user
    'admin_role' => 'admin', // Role name for admin users
    'default_colors' => [
        'primary_color' => '#3490dc',
        'secondary_color' => '#ffed4a',
        'background_color' => '#ffffff',
        'text_color' => '#1a202c',
    ],
];
