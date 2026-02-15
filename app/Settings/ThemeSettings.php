<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeSettings extends Settings
{
    public string $name;

    public string $logo_light;

    public string $logo_dark;

    public string $favicon;

    public string $theme;

    public string $layout;

    public string $color_scheme;

    public string $layout_width;

    public string $layout_position;

    public string $topbar_color;

    public string $sidebar_size;

    public string $sidebar_view;

    public string $sidebar_img;

    public string $sidebar_color;

    public static function group(): string
    {
        return 'theme';
    }
}
