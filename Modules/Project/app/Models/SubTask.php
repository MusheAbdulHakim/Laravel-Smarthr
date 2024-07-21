<?php

namespace Modules\Project\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Database\Factories\SubTaskFactory;

class SubTask extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'task_id','startDate','endDate','added_by',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class,'task_id');
    }

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }

   
}
