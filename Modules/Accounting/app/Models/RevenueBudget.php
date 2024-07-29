<?php

namespace Modules\Accounting\Models;

use Modules\Accounting\Models\Budget;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounting\Models\BudgetCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounting\Database\Factories\RevenueBudgetFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class RevenueBudget extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title','budget_id','budget_category_id','startDate','endDate','amount','note'
    ];

    public function budget(){
        return $this->belongsTo(Budget::class);
    }

    public function category(){
        return $this->belongsTo(BudgetCategory::class,'budget_category_id');
    }

    protected static function newFactory(): RevenueBudgetFactory
    {
        return RevenueBudgetFactory::new();
    }
}
