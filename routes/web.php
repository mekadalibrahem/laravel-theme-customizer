<?php

use Illuminate\Support\Facades\Route;
use Mekad\LaravelThemeCustomizer\Http\Controllers\ThemeController;

Route::middleware(['theme'])->group(function () {
    Route::get('/theme', [ThemeController::class, 'show'])->name('theme-customizer.show');
    Route::post('/theme', [ThemeController::class, 'update'])->name('theme-customizer.update');
    Route::post('/theme-customizer/set-active', [ThemeController::class, 'setActive'])->name('theme-customizer.set-active');
Route::post('/theme-customizer/get-theme', [ThemeController::class, 'getTheme'])->name('theme-customizer.get-theme');
});
Route::get('/theme-test', function () {
    return 'Theme route works!';
});
