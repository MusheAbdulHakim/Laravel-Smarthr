<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name','purchase_date','purchase_from',
        'manufacturer','model','serial_number',
        'supplier','condition','warranty','value',
        'description','status','uuid'
    ];

    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => 'assets','field' => 'uuid', 'length' => 10, 'prefix' =>'#AST-']);
        });
    }
    

}
