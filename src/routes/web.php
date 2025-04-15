<?php

use Illuminate\Support\Facades\Route;
use Mekad\LaravelThemeCustomizer\Http\Controllers\ThemeController;

Route::middleware(['auth', 'theme'])->prefix('admin')->group(function () {
    Route::get('/theme', [ThemeController::class, 'show'])->name('theme-customizer.show');
    Route::post('/theme', [ThemeController::class, 'update'])->name('theme-customizer.update');
});