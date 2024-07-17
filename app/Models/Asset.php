<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $casts = [
        'files' => 'array'
    ];

    protected $fillable = [
        'name','purchase_date','purchase_from',
        'manufacturer','model','serial_no',
        'supplier','ast_condition','warranty', 'warranty_end','cost',
        'description','status','ast_id','user_id','files','created_by','brand'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function issues()
    {
        return $this->hasMany(AssetIssue::class);
    }
}
