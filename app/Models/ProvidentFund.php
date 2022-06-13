<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvidentFund extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','type',
        'employee_share_amount',
        'org_share_amount','employee_share_percent',
        'org_share_percent','description'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
