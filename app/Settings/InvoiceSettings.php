<?php 
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class InvoiceSettings extends Settings{

    public string $prefix, $logo;

    public static function group(): string
    {
        return 'invoice';
    }
}

