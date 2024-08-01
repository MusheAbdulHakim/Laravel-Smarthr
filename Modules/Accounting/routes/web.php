<?php

use Illuminate\Support\Facades\Route;
use Modules\Accounting\Http\Controllers\BudgetsController;
use Modules\Accounting\Http\Controllers\ExpenseBudgetController;
use Modules\Accounting\Http\Controllers\RevenueBudgetController;
use Modules\Accounting\Http\Controllers\BudgetCategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'accounting','middleware' => ['auth']], function () {
    Route::resource('budget-categories', BudgetCategoriesController::class)->except('show')->names('budget.categories');
    Route::resource('budget-expense', ExpenseBudgetController::class)->except('show')->names('budget.expense');
    Route::resource('budget-revenue', RevenueBudgetController::class)->except('show')->names('budget.revenue');
    Route::resource('budgets', BudgetsController::class);
});
