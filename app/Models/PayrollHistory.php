<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollHistory extends Model
{
    use HasFactory;

    protected $fillable = [
    'employee_name',
    'employee_id', 
    'monthYear', 
    'department',
    'designation',
    'net'
    ];

   
}
