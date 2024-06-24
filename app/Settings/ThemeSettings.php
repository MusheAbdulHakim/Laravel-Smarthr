<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeSettings extends Settings
{

    public string $name, $logo_light, $logo_dark, $favicon, $theme,
        $layout, $color_scheme, $layout_width, $layout_position,
        $topbar_color, $sidebar_size, $sidebar_view, $sidebar_img, $sidebar_color;


    public static function group(): string
    {
        return 'theme';
    }
}
