<?php

use Illuminate\Support\Facades\Route;
use Modules\Roles\Http\Controllers\RolesController;

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

Route::group(['middleware' => ['auth']], function () {

    Route::get('roles/create', [RolesController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RolesController::class,'store'])->name('roles.store');
    Route::get('edit-role/{role}', [RolesController::class,'edit'])->name('roles.edit');
    Route::post('permissions/{role?}', [RolesController::class, 'updatePermission'])->name('permissions.update');
    Route::put('roles', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('delete-role/{role}', [RolesController::class, 'destroy'])->name('roles.destroy');
    Route::get('roles/{id?}', [RolesController::class, 'index'])->name('roles.index');
});


