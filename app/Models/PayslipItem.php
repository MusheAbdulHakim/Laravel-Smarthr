<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'payslip_id','type','item_id'
    ];

    public function payslip()
    {
        return $this->belongsTo(Payslip::class,'payslip_id');
    }

    public function allowances()
    {
        if($this->type === 'allowance'){
            return $this->belongsTo(EmployeeAllowance::class, 'item_id');
        }
    }

    public function deductions()
    {
        if($this->type === 'deduction'){
            return $this->belongsTo(EmployeeDeduction::class, 'item_id');
        }
    }


}
