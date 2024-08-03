<?php

namespace App\Enums\Payroll;

enum SalaryType: string
{
    case Hourly = 'hourly';
    case Contract = 'contract';
    case Monthly = 'monthly';
    case Weekly = 'weekly';
}
