<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\DesignationsController;

include __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [UserProfileController::class, 'update']);

    Route::get('chat', [ChatController::class, 'index'])->name('app.chat');
    Route::resource('users', UsersController::class);
    Route::resource('employees', EmployeesController::class);
    Route::get('employees-list', [EmployeesController::class, 'list'])->name('employees.list');
    Route::resource('departments', DepartmentsController::class)->except(['show']);
    Route::resource('designations', DesignationsController::class)->except(['show']);

    //settings
    Route::prefix('settings')->group(function () {
        Route::get('company', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('company', [SettingsController::class, 'updateCompany'])->name('settings.company.update');

        Route::get('locale', [SettingsController::class, 'locale'])->name('settings.locale');
        Route::post('locale', [SettingsController::class, 'updateLocale'])->name('settings.locale.update');
        Route::get('theme', [SettingsController::class, 'theme'])->name('settings.theme');
        Route::post('theme', [SettingsController::class, 'updateTheme'])->name('settings.theme.update');
    });
});



Route::get('', function(){
    return view('welcome');
});
