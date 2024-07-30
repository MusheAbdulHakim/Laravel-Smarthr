<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceTimestamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','attendance_id','project_id','startTime','endTime','location',
        'billable','ip','note'
    ];

    protected $casts = [
        'startTime' => 'datetime:H:i:s',
        'endTime' => 'datetime:H:i:s',
    ];

    public function getTotalHoursAttribute()
    {
        return !empty($this->endTime) ? $this->endTime->diff($this->startTime)->hour: now()->diff($this->startTime)->hour;
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id');
    }

    public function project(){
        return $this->belongsTo(\Modules\Project\Models\Project::class, 'project_id');
    }
}
