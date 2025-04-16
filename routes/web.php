<?php

use Illuminate\Support\Facades\Route;
use Mekad\LaravelThemeCustomizer\Http\Controllers\ThemeController;

Route::middleware(['theme'])->group(function () {
    Route::get('/theme', [ThemeController::class, 'show'])->name('theme-customizer.show');
    Route::post('/theme', [ThemeController::class, 'update'])->name('theme-customizer.update');
});
Route::get('/theme-test', function () {
    return 'Theme route works!';
});
