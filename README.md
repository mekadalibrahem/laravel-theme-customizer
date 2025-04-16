# Laravel Theme Customizer

A Laravel package that allows you to customize your application's theme colors and settings.

## Features

- Global and user-specific theme customization
- Color picker for primary, secondary, and accent colors
- Light and dark mode support
- Role-based access control for theme management
- Default themes included
- Easy installation and setup

## Installation

1. Install the package via Composer:

```bash
composer require mekad/laravel-theme-customizer
```

2. Publish the package assets:

```bash
php artisan vendor:publish --provider="Mekad\LaravelThemeCustomizer\ThemeCustomizerServiceProvider"
```

3. Run the installation command:

```bash
php artisan theme-customizer:install
```

This will:

- Run the necessary migrations
- Seed the database with default themes
- Set up the required configuration

## Default Themes

The package comes with three pre-configured global themes:

1. **Dark Blue & Green** (Active by default)
   - Primary: #1a3a6c
   - Secondary: #1e4d45
   - Accent: #ffc107

2. **Light Blue & Green**
   - Primary: #3490dc
   - Secondary: #38a169
   - Accent: #f6ad55

3. **Purple & Teal**
   - Primary: #6b46c1
   - Secondary: #319795
   - Accent: #f687b3

## Configuration

After installation, you can configure the package by editing the `config/theme-customizer.php` file. The main configuration options are:

```php
return [
    'theme_mode' => 'admin', // 'admin' or 'user'
    'roles' => [
        'enabled' => true,
        'admin_role' => 'admin',
    ],
    'default_colors' => [
        'primary_color' => '#1a3a6c',
        'secondary_color' => '#1e4d45',
        'light_primary' => '#2c5eaa',
        'light_secondary' => '#2a6b5f',
        'accent_color' => '#ffc107',
        'text_light' => '#f8f9fa',
        'text_dark' => '#343a40',
        'dark_background' => '#1a1a24',
    ],
];
```

## Usage

### Blade Components

Use the provided Blade components to apply themes to your views:

```blade
<x-laravel-theme-customizer::theme-styles />
```

### Theme Management

Access the theme management interface at `/theme-customizer` (requires admin role if theme_mode is set to 'admin').

#### Available Actions

- Create/Update themes
- Set active theme
- Delete themes (cannot delete active theme)
- Preview theme changes

## Requirements

- PHP >= 8.1
- Laravel >= 9.0
- Composer

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

If you find a bug or have a feature request, please open an issue on the [GitHub repository](https://github.com/yourusername/laravel-theme-customizer).
