<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LocalizationSettings extends Settings
{

    public $country, $date_format, $timezone, $lang, $currency_symbol, $currency_code;

    public static function group(): string
    {
        return 'localization';
    }
}
