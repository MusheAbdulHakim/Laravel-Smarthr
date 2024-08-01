<?php

namespace Modules\Project\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Project\Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'project_id','project_task_board_id','name','priority','startDate','endDate','description','created_by'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function taskBoard()
    {
        return $this->belongsTo(ProjectTaskBoard::class,'project_task_board_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function followers()
    {
        return $this->hasMany(TaskFollower::class);
    }
    
    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }
    
    
}
