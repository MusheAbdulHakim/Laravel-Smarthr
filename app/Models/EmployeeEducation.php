<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_detail_id', 'institution', 'subject', 'course', 'grade', 'file', 'start_date',
        'end_date',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeDetail::class,);
    }
}
