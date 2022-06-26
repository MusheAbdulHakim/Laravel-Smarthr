<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'inv_id','client_id','project_id','tax_id',
        'email','client_address','billing_address',
        'invoice_date','due_date','items','note','discount','total','status'
    ];

    protected $casts = [
        'items' => 'array'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function tax(){
        return $this->belongsTo(Tax::class);
    }
}
