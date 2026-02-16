<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSettings extends Settings
{
    public $mailer;

    public $from_address;

    public $from_name;

    public $host;

    public $port;

    public $enc;

    public $domain;

    public $user;

    public $password;

    public static function group(): string
    {
        return 'email';
    }
}
