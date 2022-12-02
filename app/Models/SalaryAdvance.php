<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryAdvance extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'rate_amount',
        'employee_id',
        'date',
        'status',
        'duration',
        'emi',
        'total_repayments',
        'loan_status'
    ];


    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    
}
