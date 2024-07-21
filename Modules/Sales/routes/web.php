<?php

use Illuminate\Support\Facades\Route;
use Modules\Sales\Http\Controllers\SalesController;
use Modules\Sales\Http\Controllers\TaxesController;

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

Route::group(['prefix' => 'sales'], function () {
    Route::resource('taxes', TaxesController::class)->except(['show']);
});
