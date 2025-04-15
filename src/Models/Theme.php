<?php

namespace Mekad\LaravelThemeCustomizer\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'user_id',
        'is_global',
        'primary_color',
        'secondary_color',
        'background_color',
        'text_color',
    ];

    protected $casts = [
        'is_global' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}