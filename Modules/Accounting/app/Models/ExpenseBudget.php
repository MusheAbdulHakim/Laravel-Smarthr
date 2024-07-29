<?php

namespace Modules\Accounting\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounting\Database\Factories\ExpenseBudgetFactory;
use Spatie\MediaLibrary\InteractsWithMedia;

class ExpenseBudget extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title','budget_id','budget_category_id','startDate','endDate','amount','note'
    ];

    public function budget(){
        return $this->belongsTo(Budget::class,'budget_id');
    }

    public function category(){
        return $this->belongsTo(BudgetCategory::class,'budget_category_id');
    }

    protected static function newFactory(): ExpenseBudgetFactory
    {
        return ExpenseBudgetFactory::new();
    }
}
