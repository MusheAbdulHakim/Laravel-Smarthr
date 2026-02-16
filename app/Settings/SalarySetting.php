<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SalarySetting extends Settings
{
    public bool $enable_da_hra;

    public bool $enable_provident_fund;

    public bool $enable_esi_fund;

    public string $da_percent;

    public string $hra_percent;

    public string $emp_pf_percentage;

    public string $company_pf_percentage;

    public string $emp_esi_percentage;

    public string $company_esi_percentage;

    public static function group(): string
    {
        return 'general_salary';
    }
}
