<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','clt_id','billing_address','post_address'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
