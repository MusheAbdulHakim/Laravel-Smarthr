<?php

use App\Events\AppMenuEvent;
use App\Events\AppSettingsMenuEvent;
use App\Helpers\AppMenu;
use App\Settings\ThemeSettings;
use App\Settings\LocalizationSettings;
use Illuminate\Support\Facades\Route;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

if (!function_exists('route_is')) {
    function route_is($route = null)
    {
        if (request()->is($route) || request()->routeIs($route) || Route::currentRouteName() == $route) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('route_is')) {
    function route_is($routes = [])
    {
        foreach ($routes as $route) {
            if (request()->is($route) || request()->routeIs($route) || Route::currentRouteName() == $route) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('json_parse')) {
    function json_parse(array $data)
    {
        return htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
    }
}


/**
 * Generate a random string, using a cryptographically secure
 * pseudorandom number generator (random_int)
 *
 * This function uses type hints now (PHP 7+ only), but it was originally
 * written for PHP 5 as well.
 *
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 *
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    $keyspace = str_shuffle($keyspace);
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

if (!function_exists('format_date')) {
    /**
     * Format Date
     *
     * @param string|date $date
     * @param string $format
     * @return void
     */
    function format_date($date, $format = 'Y-m-d')
    {
        return date_format(date_create($date), $format);
    }
}


if (!function_exists('renderAppMenu')) {
    function renderAppMenu()
    {
        $appMenu = new AppMenu();
        event(new AppMenuEvent($appMenu));
        return $appMenu->menu->render();
    }
}

if (!function_exists('getSetting')) {
    function getSetting($class)
    {
        return app($class);
    }
}


if (!function_exists('Theme')) {
    function Theme($property = null)
    {
        return !empty($property) ? app(ThemeSettings::class)->$property : app(ThemeSettings::class);
    }
}

if (!function_exists('LocaleSettings')) {
    function LocaleSettings($property = null)
    {
        return !empty($property) ? app(LocalizationSettings::class)->$property : app(LocalizationSettings::class);
    }
}

if (!function_exists('uploadedAsset')) {
    function uploadedAssed($asset, $directory = '')
    {
        return ($directory !== '') ? asset("storage/$directory/$asset") : asset("storage/$asset");
    }
}


if (!function_exists('renderAppSettingsMenu')) {
    function renderAppSettingsMenu()
    {
        $appMenu = new AppMenu();
        event(new AppSettingsMenuEvent($appMenu));
        return $appMenu->settingsMenu->render();
    }
}
