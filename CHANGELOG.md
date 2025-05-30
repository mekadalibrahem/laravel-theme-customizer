# Changelog

All notable changes to `laravel-theme-customizer` will be documented in this file.

## [Unreleased]

### Added

- Configurable route settings (prefix, middleware, name prefix)
- Comprehensive documentation for all classes and methods
- Support for both global and user-specific themes
- Theme preview functionality
- Color validation for theme updates
- Configurable role-based access control
- Option to disable role checking

### Changed

- Removed 'name' field from theme updates
- Improved theme editor interface
- Enhanced theme selector to use theme key instead of name
- Updated configuration structure for better customization
- Improved role checking implementation
- Enhanced error handling for unauthorized access

### Fixed

- Fixed User model namespace in Theme model
- Improved theme activation handling
- Enhanced error handling for theme operations
- Fixed role checking in admin mode

## [1.0.0] - 2024-04-16

### Added

- Initial release of Laravel Theme Customizer
- Basic theme management functionality
- Support for Tailwind and Bootstrap frameworks
- Theme editor interface
- Database migrations for themes table
