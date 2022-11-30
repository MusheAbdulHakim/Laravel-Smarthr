<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGrades extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_scale',
        'salary_amount',
        'salary_currency'
       
    ];
}
