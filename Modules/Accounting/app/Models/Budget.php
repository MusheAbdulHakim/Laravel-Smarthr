<?php

namespace Modules\Accounting\Models;

use Modules\Project\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounting\Database\Factories\BudgetFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Budget extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title','type','startDate','endDate','total_revenue','total_expense',
        'profit','budget_category_id','project_id','taxes','amount','note'
    ];

    public function category()
    {
        return $this->belongsTo(BudgetCategory::class, 'budget_category_id');
    }

    public function expenses()
    {
        return $this->hasMany(ExpenseBudget::class);
    }

    public function revenue(){
        return $this->hasMany(RevenueBudget::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    protected static function newFactory(): BudgetFactory
    {
        return BudgetFactory::new();
    }
}
