<?php

namespace App\Models;

use App\Enums\Payroll\SalaryType;
use App\Enums\Payroll\PaymentMethod;
use Database\Factories\EmployeeSalaryDetailFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSalaryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_detail_id','basis','base_salary','payment_method','pf_contribution',
        'pf_number','additional_pf','total_pf_rate',
        'esi_contribution','esi_number','additional_esi_rate','total_additional_esi_rate'
    ];

    protected $casts = [
        'basis' => SalaryType::class,
        'payment_method' => PaymentMethod::class,
    ];

    public function employeeDetail()
    {
        return $this->belongsTo(EmployeeDetail::class, 'employee_detail_id');
    }

    protected static function newFactory(): EmployeeSalaryDetailFactory
    {
        return EmployeeSalaryDetailFactory::new();
    }
    
}
