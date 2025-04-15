<?php

namespace Mekad\LaravelThemeCustomizer\Repositories;

use Mekad\LaravelThemeCustomizer\Models\Theme;

class ThemeRepository implements ThemeRepositoryInterface
{
    protected $model;

    public function __construct(Theme $model)
    {
        $this->model = $model;
    }

    public function getByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->where('is_global', false)->first();
    }

    public function getGlobalTheme()
    {
        return $this->model->where('is_global', true)->first();
    }

    public function updateOrCreate($userId, array $data, bool $isGlobal = false)
    {
        return $this->model->updateOrCreate(
            ['user_id' => $userId, 'is_global' => $isGlobal],
            array_merge($data, ['is_global' => $isGlobal])
        );
    }
}