<?php

namespace Mekad\LaravelThemeCustomizer\Colors;

use Mekad\LaravelThemeCustomizer\Colors\Contracts\ColorStrategyInterface;
use Mekad\LaravelThemeCustomizer\Colors\Strategies\DarkenStrategy;
use Mekad\LaravelThemeCustomizer\Colors\Strategies\LightenStrategy;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class ColorManager
{
    private array $strategies = [];
    private array $shadowConfig;
    private array $namingConfig;


    public function __construct()
    {
        $this->registerDefaultStrategies();
        $this->shadowConfig = Config::get('theme-customizer.shadows', [
            'enabled' => true,
            'default_strategy' => 'darken',

            'percents' => [5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 95],
            'naming_convention' => 'numeric',
            'semantic_names' => [],
        ]);

        $this->namingConfig = Config::get('theme-customizer.naming', [
            'prefix' => 'theme-',
            'format' => 'kebab',
            'colors-name' => [
                'primary' => 'primary',
                'secondary' => 'secondary',
                'accent' => 'accent',
                'warning' => 'warning',
                'success' => 'success',
                'highlight' => 'highlight',
                'dark' => 'dark',
                'neutral' => 'neutral',
                'light' => 'light',
            ],
        ]);
    }

    private function registerDefaultStrategies(): void
    {
        $this->registerStrategy('darken', new DarkenStrategy());
        $this->registerStrategy('lighten', new LightenStrategy());
    }

    public function registerStrategy(string $name, ColorStrategyInterface $strategy): void
    {
        $this->strategies[$name] = $strategy;
    }

    public function convert(string $strategyName, string $color, array $options = []): string
    {
        if (!isset($this->strategies[$strategyName])) {
            throw new \InvalidArgumentException("Strategy '{$strategyName}' not found");
        }

        return $this->strategies[$strategyName]->convert($color, $options);
    }

    public function darken(string $color, int $percent = 20): string
    {
        return $this->convert('darken', $color, ['percent' => $percent]);
    }

    public function lighten(string $color, int $percent = 20): string
    {
        return $this->convert('lighten', $color, ['percent' => $percent]);
    }

    public function getAvailableStrategies(): array
    {
        return array_keys($this->strategies);
    }

    public function generateShadows(string $color, ?string $strategy = null): array
    {
        if (!$this->shadowConfig['enabled']) {
            return [];
        }

        $strategy = $strategy ?? $this->shadowConfig['default_strategy'];
        $shadows = [];

        foreach ($this->shadowConfig['percents'] as $percent) {
            $shadowColor = $this->convert($strategy, $color, ['percent' => $percent]);

            if ($this->shadowConfig['naming_convention'] === 'semantic') {
                $name = $this->shadowConfig['semantic_names'][$percent] ?? $percent;
            } else {
                $name = $percent;
            }

            $shadows[$name] = $shadowColor;
        }

        return $shadows;
    }

    public function formatColorName(string $name, ?string $variant = null): string
    {
        $colorName = $this->namingConfig['colors-name'][$name];
        $formattedName = $this->formatName($colorName);
        
        if ($variant) {
            $formattedName .= '-' . $this->formatName($variant);
        }

        return $this->namingConfig['prefix'] . $formattedName;
    }

    private function formatName(string $name): string
    {
        return match ($this->namingConfig['format']) {
            'kebab' => Str::kebab($name),
            'snake' => Str::snake($name),
            'camel' => Str::camel($name),
            default => $name,
        };
    }

    public function isShadowsEnabled(): bool
    {
        return $this->shadowConfig['enabled'];
    }

    public function getDefaultStrategy(): string
    {
        return $this->shadowConfig['default_strategy'];
    }

    public function getShadowPercents(): array
    {
        return $this->shadowConfig['percents'];
    }

    public function getNamingConvention(): string
    {
        return $this->shadowConfig['naming_convention'];
    }

    protected function getAllColorShadows(string $color): array
    {
        return $this->generateShadows($color);
    }
}
