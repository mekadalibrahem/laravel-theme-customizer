<?php

namespace Mekad\LaravelThemeCustomizer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThemeColor extends Model
{
    protected $fillable = [
        'theme_id',
        'primary',
        'secondary',
        'accent',
        'warning',
        'success',
        'highlight',
        'dark',
        'neutral',
        'light',
    ];

    protected $casts = [
        'primary' => 'string',
        'secondary' => 'string',
        'accent' => 'string',
        'warning' => 'string',
        'success' => 'string',
        'highlight' => 'string',
        'dark' => 'string',
        'neutral' => 'string',
        'light' => 'string',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }
}
