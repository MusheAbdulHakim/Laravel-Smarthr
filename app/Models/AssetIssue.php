<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id','description','raised_by'
    ];

    public function asset(){
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function raisedBy(){
        return $this->belongsTo(User::class,'raised_by');
    }
}
