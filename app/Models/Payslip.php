<?php

namespace App\Models;

use App\Enums\Payroll\SalaryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'ps_id','title','employee_detail_id',
        'use_allowance',
        'use_deduction','payslip_date','weeks','type',
        'total_hours','net_pay','startDate','endDate'
    ];

    protected $casts = [
        'type' => SalaryType::class,
    ];

    public function allowances()
    {
        return $this->items()
            ->where('type','allowance')
            ->get()
            ->map(function(PayslipItem $model){
                return $model->allowances;
            });
    }
    public function deductions()
    {
        return $this->items()
            ->where('type','deduction')
            ->get()
            ->map(function(PayslipItem $model){
                return $model->deductions;
            });
    }

    public function items()
    {
        return $this->hasMany(PayslipItem::class,'payslip_id');
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeDetail::class, 'employee_detail_id');
    }
}
