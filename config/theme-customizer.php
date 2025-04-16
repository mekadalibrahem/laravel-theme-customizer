<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Theme Framework
    |--------------------------------------------------------------------------
    |
    | Specifies which CSS framework to use for styling the theme editor.
    | Valid options: 'tailwind', 'bootstrap'
    |
    */
    'framework' => 'tailwind',

    /*
    |--------------------------------------------------------------------------
    | Theme Mode
    |--------------------------------------------------------------------------
    |
    | Determines whether themes are managed globally by admin or per user.
    | Valid options: 'admin', 'user'
    | - admin: Only users with admin role can manage themes
    | - user: Each user can manage their own themes
    |
    */
    'theme_mode' => 'user',

    /*
    |--------------------------------------------------------------------------
    | Admin Role
    |--------------------------------------------------------------------------
    |
    | The role name that identifies admin users who can manage global themes.
    | This is used when theme_mode is set to 'admin'.
    |
    */
    'admin_role' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Default Colors
    |--------------------------------------------------------------------------
    |
    | Default color values used when no theme is active or when creating a new theme.
    | All colors must be in hex format (#RRGGBB).
    |
    */
    'default_colors' => [
        'key' => 'default_theme',        // Unique identifier for the default theme
        'primary_color' => '#3490dc',    // Main brand color
        'secondary_color' => '#ffed4a',  // Secondary brand color
        'light_primary' => '#6cb2eb',    // Lighter shade of primary color
        'light_secondary' => '#fff5a1',  // Lighter shade of secondary color
        'accent_color' => '#e3342f',     // Accent color for highlights
        'text_light' => '#ffffff',       // Light text color
        'text_dark' => '#1a202c',        // Dark text color
        'dark_background' => '#2d3748',  // Dark background color
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Enable or disable caching of theme data.
    | Valid options: true, false
    |
    */
    'cache' => false,

    /*
    |--------------------------------------------------------------------------
    | Routes Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for theme customizer routes.
    |
    */
    'routes' => [
        /*
        |--------------------------------------------------------------------------
        | Route Prefix
        |--------------------------------------------------------------------------
        |
        | The URL prefix for all theme customizer routes.
        | Example: 'theme-customizer' will create routes like /theme-customizer/show
        |
        */
        'prefix' => 'theme-customizer',

        /*
        |--------------------------------------------------------------------------
        | Route Middleware
        |--------------------------------------------------------------------------
        |
        | Middleware to apply to all theme customizer routes.
        | Can be a string or array of middleware names.
        | Example: ['web', 'auth'] or 'web'
        |
        */
        'middleware' => ['web'],

        /*
        |--------------------------------------------------------------------------
        | Route Name Prefix
        |--------------------------------------------------------------------------
        |
        | Prefix for all route names.
        | Example: 'theme-customizer.' will create route names like theme-customizer.show
        |
        */
        'name_prefix' => 'theme-customizer.',
    ],
];
