<?php

namespace Mekad\LaravelThemeCustomizer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Theme Model
 *
 * Represents a theme in the system with the following attributes:
 * - id: Unique identifier
 * - user_id: Owner of the theme (null for global themes)
 * - is_global: Whether the theme is global or user-specific
 * - key: Unique key for the theme
 * - is_active: Whether the theme is currently active
 * - Color attributes: primary_color, secondary_color, etc.
 */
class Theme extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'is_global',
        'key',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_global' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the theme.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colors(): HasOne
    {
        return $this->hasOne(ThemeColor::class);
    }
}
