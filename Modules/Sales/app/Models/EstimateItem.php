<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sales\Database\Factories\EstimateItemFactory;

class EstimateItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'estimate_id','name','description','unit_cost','quantity','total'
    ];

    protected static function newFactory(): EstimateItemFactory
    {
        return EstimateItemFactory::new();
    }
}
