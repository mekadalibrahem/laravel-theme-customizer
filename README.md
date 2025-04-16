# Laravel Theme Customizer

A powerful Laravel package that allows you to customize and manage themes for your application. Supports both global themes (admin-managed) and user-specific themes.

## Features

- 🎨 Easy theme customization with color picker
- 👥 Support for both global and user-specific themes
- 🎭 Framework agnostic (works with Tailwind and Bootstrap)
- 🔄 Real-time theme preview
- 🔒 Role-based access control
- ⚙️ Configurable routes and middleware
- 📱 Responsive design

## Requirements

- PHP >= 8.1
- Laravel >= 9.0
- MySQL/PostgreSQL/SQLite

## Installation

1. Install the package via Composer:

```bash
composer require mekad/laravel-theme-customizer
```

2. Publish the package assets:

```bash
php artisan vendor:publish --provider="Mekad\LaravelThemeCustomizer\ThemeCustomizerServiceProvider"
```

3. Run the migrations:

```bash
php artisan migrate
```

## Configuration

After installation, you can configure the package by modifying the `config/theme-customizer.php` file:

```php
return [
    'framework' => 'tailwind', // or 'bootstrap'
    'theme_mode' => 'user', // or 'admin'
    'admin_role' => 'admin',
    'routes' => [
        'prefix' => 'theme-customizer',
        'middleware' => ['web'],
        'name_prefix' => 'theme-customizer.',
    ],
    // ... other configuration options
];
```

## Usage

### Basic Usage

1. Add the theme editor to your view:

```php
@include('laravel-theme-customizer::components.theme-editor')
```

2. Access the theme editor at the configured route (default: `/theme-customizer`)

### Theme Modes

#### Admin Mode

When `theme_mode` is set to 'admin':

- Only users with the admin role can manage themes
- Themes are global and affect all users
- Changes apply to the entire application

#### User Mode

When `theme_mode` is set to 'user':

- Each user can manage their own themes
- Themes are user-specific
- Users can switch between their themes

### Customizing Routes

You can customize the routes in the config file:

```php
'routes' => [
    'prefix' => 'admin/themes', // Custom URL prefix
    'middleware' => ['web', 'auth', 'admin'], // Custom middleware
    'name_prefix' => 'admin.themes.', // Custom route name prefix
],
```

### Theme Data Structure

Themes are stored with the following structure:

```php
[
    'key' => 'unique_theme_key',
    'primary_color' => '#3490dc',
    'secondary_color' => '#ffed4a',
    'light_primary' => '#6cb2eb',
    'light_secondary' => '#fff5a1',
    'accent_color' => '#e3342f',
    'text_light' => '#ffffff',
    'text_dark' => '#1a202c',
    'dark_background' => '#2d3748',
]
```

## API

### ThemeController

The package provides the following endpoints:

- `GET /theme-customizer` - Show theme editor
- `POST /theme-customizer` - Update/create theme
- `POST /theme-customizer/set-active` - Set active theme
- `POST /theme-customizer/get-theme` - Get theme data

### ThemeRepository

Available methods for theme management:

```php
$themeRepository->getGlobalThemes();
$themeRepository->getActiveGlobalTheme();
$themeRepository->getByUserId($userId);
$themeRepository->getActiveThemeByUserId($userId);
$themeRepository->updateOrCreate($userId, $data, $isGlobal);
$themeRepository->setActiveTheme($userId, $themeId);
$themeRepository->setActiveGlobalTheme($themeId);
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).
