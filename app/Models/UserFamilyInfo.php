<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFamilyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','name','relationship','dob','phone','address','picture'
    ];

    protected $casts = [
        'dob' => 'date'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
