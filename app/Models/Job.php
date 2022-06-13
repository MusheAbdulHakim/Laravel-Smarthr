<?php

namespace App\Models;

use App\Models\Department;
use App\Models\JobApplicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'title','department_id','location','vacancies',
        'experience','age','salary_from','salary_to','type',
        'status','start_date','expire_date',
        'description',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function JobApplicants(){
        return $this->hasMany(JobApplicant::class);
    }
}
