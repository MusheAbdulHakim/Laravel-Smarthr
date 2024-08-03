<?php

namespace App\Models;

use App\Enums\MaritalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'emp_id', 'user_id', 'department_id', 'designation_id',
        'passport_no', 'passport_expiry_date', 'passport_tel', 'nationality', 'religion', 'ethnicity',
        'marital_status', 'spouse_occupation', 'no_of_children', 'emergency_contacts', 'date_joined', 'dob',
    ];

    protected $casts = [
        'emergency_contacts' => 'collection',
        'date_joined' => 'date',
        'marital_status' => MaritalStatus::class,
    ];

    public function education()
    {
        return $this->hasMany(EmployeeEducation::class);
    }

    public function workExperience()
    {
        return $this->hasMany(EmployeeWorkExperience::class, 'employee_detail_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function salaryDetails()
    {
        return $this->hasOne(EmployeeSalaryDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allowances()
    {
        return $this->hasMany(EmployeeAllowance::class);
    }

    public function deductions()
    {
        return $this->hasMany(EmployeeDeduction::class);
    }
}
