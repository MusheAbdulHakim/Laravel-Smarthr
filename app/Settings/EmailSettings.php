<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSettings extends Settings
{

    public $mailer, $from_address, $from_name, $host, $port, $enc, $domain, $user, $password;

    public static function group(): string
    {
        return 'email';
    }
}