<?php

namespace Modules\Project\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Database\Factories\TaskBoardFactory;

class TaskBoard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name','color','priority','created_by'
    ];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
