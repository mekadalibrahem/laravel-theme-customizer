<?php

namespace Mekad\LaravelThemeCustomizer\Colors\Strategies;

use Mekad\LaravelThemeCustomizer\Colors\Contracts\ColorStrategyInterface;

class LightenStrategy implements ColorStrategyInterface
{
    public function convert(string $color, array $options = []): string
    {
        $percent = $options['percent'] ?? 20;
        $hex = str_replace('#', '', $color);

        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        if (strlen($hex) != 6) {
            return '#FFFFFF';
        }

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $factor = 1 + ($percent / 100);
        $r = max(0, min(255, $r * $factor));
        $g = max(0, min(255, $g * $factor));
        $b = max(0, min(255, $b * $factor));

        $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
        $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
        $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

        return '#' . $r_hex . $g_hex . $b_hex;
    }
}
