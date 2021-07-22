<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname','lastname',
        'email','phone',
        'department_id','designation_id','company','avatar',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'length' => 7, 'prefix' =>date('EM-')]);
        });
    }

}
