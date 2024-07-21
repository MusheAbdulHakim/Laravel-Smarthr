<?php

namespace Modules\Project\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Database\Factories\TaskCommentFactory;

class TaskComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id','task_id','message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task(){
        return $this->belongsTo(Task::class, 'task_id');
    }
    
}
