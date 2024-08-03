<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SalarySetting extends Settings
{

    public bool $enable_da_hra, $enable_provident_fund, $enable_esi_fund;

    public string $da_percent, $hra_percent, $emp_pf_percentage, $company_pf_percentage, $emp_esi_percentage, $company_esi_percentage;

    public static function group(): string
    {
        return 'general_salary';
    }
}