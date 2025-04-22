<?php

namespace Mekad\LaravelThemeCustomizer\Colors\Contracts;

interface ColorStrategyInterface
{
    /**
     * Convert a color value based on the strategy
     *
     * @param string $color The color value to convert
     * @param array $options Additional options for the conversion
     * @return string The converted color value
     */
    public function convert(string $color, array $options = []): string;
}
