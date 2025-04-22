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
    'theme_mode' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Role Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for role-based access control.
    |
    */
    'roles' => [
        /*
        |--------------------------------------------------------------------------
        | Enable Role Check
        |--------------------------------------------------------------------------
        |
        | Whether to enable role-based access control.
        | Set to false to disable role checking completely.
        |
        */
        'enabled' => false,

        /*
        |--------------------------------------------------------------------------
        | Admin Role
        |--------------------------------------------------------------------------
        |
        | The role name that identifies admin users who can manage global themes.
        | This is used when theme_mode is set to 'admin' and roles.enabled is true.
        |
        */
        'admin_role' => 'admin',
    ],

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
        'primary' => '#3B82F6',    // Blue
        'secondary' => '#10B981',  // Green
        'accent' => '#8B5CF6',     // Purple
        'warning' => '#F59E0B',    // Orange
        'success' => '#10B981',    // Green
        'highlight' => '#EC4899',  // Pink
        'dark' => '#1F2937',       // Dark Gray
        'neutral' => '#6B7280',    // Gray
        'light' => '#F3F4F6',      // Light Gray
    ],

    /*
    |--------------------------------------------------------------------------
    | Color Naming Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for color naming conventions.
    |
    */
    'naming' => [
        /*
        |--------------------------------------------------------------------------
        | CSS Variable Prefix
        |--------------------------------------------------------------------------
        |
        | The prefix to use for CSS variables.
        | Example: 'theme-' will generate variables like --theme-primary-color
        |
        */
        'prefix' => 'color-',

        'colors-name' => [
            'primary' => 'primary',
            'secondary' => 'secondary',
            'accent' => 'accent',
            'warning' => 'warning',
            'success' => 'success',
            'highlight' => 'highlight',
            'dark' => 'dark',
            'neutral' => 'neutral',
            'light' => 'light',
        ],

        /*
        |--------------------------------------------------------------------------
        | Color Name Format
        |--------------------------------------------------------------------------
        |
        | The format to use for color names.
        | Available options: 'kebab', 'snake', 'camel'
        |
        | kebab: primary-color
        | snake: primary_color
        | camel: primaryColor
        |
        */
        'format' => 'kebab',
    ],

    /*
    |--------------------------------------------------------------------------
    | Shadow Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for color shadow generation.
    |
    */
    'shadows' => [
        /*
        |--------------------------------------------------------------------------
        | Enable Shadows
        |--------------------------------------------------------------------------
        |
        | Whether to enable shadow generation for colors.
        |
        */
        'enabled' => true,

        /*
        |--------------------------------------------------------------------------
        | Default Strategy
        |--------------------------------------------------------------------------
        |
        | The default strategy to use for shadow generation.
        | Available options: 'darken', 'lighten'
        |
        */
        'default_strategy' => 'darken',

        /*
        |--------------------------------------------------------------------------
        | Shadow Percentages
        |--------------------------------------------------------------------------
        |
        | The percentages to use when generating shadows.
        | These values will be used to create different shades of colors.
        |
        */
        'percents' => [5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 95],

        /*
        |--------------------------------------------------------------------------
        | Shadow Naming Convention
        |--------------------------------------------------------------------------
        |
        | The naming convention for shadow variants.
        | Available options: 'numeric', 'semantic'
        |
        | numeric: Uses numbers (e.g., primary-50, primary-100)
        | semantic: Uses semantic names (e.g., primary-light, primary-dark)
        |
        */
        'naming_convention' => 'numeric',

        /*
        |--------------------------------------------------------------------------
        | Semantic Names
        |--------------------------------------------------------------------------
        |
        | The semantic names to use when naming_convention is set to 'semantic'.
        | The keys represent the percentage values from the percents array.
        |
        */
        'semantic_names' => [
            5 => 'lightest',
            10 => 'lighter',
            20 => 'light',
            30 => 'base',
            40 => 'dark',
            50 => 'darker',
            60 => 'darkest',
            70 => 'darker',
            80 => 'darkest',
            90 => 'darker',
            95 => 'darkest',
        ],
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
