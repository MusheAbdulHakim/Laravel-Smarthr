<?php
namespace App\Enums;

enum MaritalStatus : string
{
    case SINGLE = "single";
    case MARRIED = "married";
    case OTHER = "other";
}
