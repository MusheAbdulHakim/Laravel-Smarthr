<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'leave_type_id','employee_id',
        'from','to','reason','status',
    ];

    public function leaveType(){
        return $this->belongsTo(LeaveType::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
