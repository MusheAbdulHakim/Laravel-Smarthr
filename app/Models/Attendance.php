<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','startDate','endDate',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function timestamps(){
        return $this->hasMany(AttendanceTimestamp::class);
    }

}
