<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Policy extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'description',
        'department_id',
        'file',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
