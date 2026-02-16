<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanySettings extends Settings
{
    public string $name;

    public string $contact_person;

    public string $address;

    public string $country;

    public string $city;

    public string $province;

    public string $postal_code;

    public string $email;

    public string $phone;

    public string $mobile;

    public string $fax;

    public string $website_url;

    public static function group(): string
    {
        return 'company';
    }
}
