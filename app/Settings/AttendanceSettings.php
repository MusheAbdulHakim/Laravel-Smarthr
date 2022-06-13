<?php
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AttendanceSettings extends Settings{

    public string $checkin_time, $checkout_time;

    public static function group(): string
    {
        return 'attendance';
    }

}

