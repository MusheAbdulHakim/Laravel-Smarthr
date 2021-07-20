<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalType extends Model
{
    use HasFactory;

    protected $fillable =[
        'type','description'
    ];
}
