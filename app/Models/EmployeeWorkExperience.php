<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_detail_id','company','location','position',
        'start_date','end_date','file',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function getdateDifferenceAttribute(){
       return $this->end_date->diff($this->start_date);
    }

    public function employee(){
        return $this->belongsTo(EmployeeDetail::class, 'employee_detail_id');
    }
}
