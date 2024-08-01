<?php

namespace App\Enums\Payroll;

enum PaymentMethod: string
{
    case Cheque = 'cheque';
    case BankTransfer = 'bank';
    case Cash = 'cash';
}
