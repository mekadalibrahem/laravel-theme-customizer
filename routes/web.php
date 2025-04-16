<?php

use Illuminate\Support\Facades\Route;
use Mekad\LaravelThemeCustomizer\Http\Controllers\ThemeController;

$prefix = config('theme-customizer.routes.prefix');
$middleware = config('theme-customizer.routes.middleware');
$namePrefix = config('theme-customizer.routes.name_prefix');

Route::prefix($prefix)
    ->middleware($middleware)
    ->name($namePrefix)
    ->group(function () {
        Route::get('/', [ThemeController::class, 'show'])->name('show');
        Route::post('/', [ThemeController::class, 'update'])->name('update');
        Route::post('/set-active', [ThemeController::class, 'setActive'])->name('set-active');
        Route::post('/get-theme', [ThemeController::class, 'getTheme'])->name('get-theme');
        Route::delete('/delete', [ThemeController::class, 'delete'])->name('delete');
    });

Route::get('/theme-test', function () {
    return 'Theme route works!';
});
