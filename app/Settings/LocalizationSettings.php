<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LocalizationSettings extends Settings
{
    public $country;

    public $date_format;

    public $timezone;

    public $lang;

    public $currency_symbol;

    public $currency_code;

    public static function group(): string
    {
        return 'localization';
    }
}
