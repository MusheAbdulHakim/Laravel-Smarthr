<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAuth');

    Route::get('forgot-password', 'forgotPassword')->name('password.email');
    Route::post('forgot-password', 'sendResetLink')->name('password.request');
    Route::get('reset-password/{token}', 'resetPassword')->name('password.reset');
    Route::post('reset-password', 'updatePassword')->name('password.update');
});
