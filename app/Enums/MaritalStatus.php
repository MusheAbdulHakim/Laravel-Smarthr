<?php
namespace App\Enums;

enum MaritalStatus : string
{
    case SINGLE = "Single";
    case MARRIED = "Married";
    case OTHER = "Other";
}
