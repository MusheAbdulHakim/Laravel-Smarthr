<?php

namespace Modules\Accounting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounting\Database\Factories\BudgetCategoryFactory;

class BudgetCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];

    protected static function newFactory(): BudgetCategoryFactory
    {
        return BudgetCategoryFactory::new();
    }
}
