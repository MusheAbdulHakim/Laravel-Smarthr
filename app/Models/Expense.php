<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','user_id','purchased_from','purchased_date',
        'payment_method','amount','file','status',
    ];

    protected function user(){
        return $this->belongsTo(User::class);
    }

    
}
