<?php

namespace App\Models;

use App\Enums\CalendarColors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','startDate','endDate','description','is_annual','color' 
    ];
    
    protected $casts = [
        'color' => CalendarColors::class,
    ];
}   
