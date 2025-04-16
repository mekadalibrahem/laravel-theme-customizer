<?php

namespace Mekad\LaravelThemeCustomizer\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'user_id',
        'is_global',
        'key',
        'primary_color',
        'secondary_color',
        'light_primary',
        'light_secondary',
        'accent_color',
        'text_light',
        'text_dark',
        'dark_background',
    ];

    protected $casts = [
        'is_global' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
