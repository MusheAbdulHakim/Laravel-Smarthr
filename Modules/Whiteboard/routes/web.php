<?php

use Illuminate\Support\Facades\Route;
use Modules\Whiteboard\Http\Controllers\TlDrawController;
use Modules\Whiteboard\Http\Controllers\WhiteboardController;

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
    Route::get('tldraw', [WhiteboardController::class,'tldraw'])->name('tldraw.index');
    Route::get('excalidraw', [WhiteboardController::class,'excalidraw'])->name('excalidraw.index');
});
