<?php

use Illuminate\Support\Facades\Route;
use Modules\Sales\Http\Controllers\SalesController;
use Modules\Sales\Http\Controllers\TaxesController;
use Modules\Sales\Http\Controllers\ExpensesController;
use Modules\Sales\Http\Controllers\InvoicesController;
use Modules\Sales\Http\Controllers\EstimatesController;

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

Route::group(['prefix' => 'sales','middleware' => ['auth']], function () {
    Route::resource('taxes', TaxesController::class);
    Route::resource('expenses', ExpensesController::class)->except('show');
    Route::resource('estimates', EstimatesController::class);
    Route::delete('estimate-item/{item}', [EstimatesController::class, 'destroyItem'])->name('estimate-item.destroy');
    Route::any('estimate-pdf/{estimate}', [EstimatesController::class, 'downloadPdf'])->name('estimate.pdf');
    Route::resource('invoices', InvoicesController::class);
});
