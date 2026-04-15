<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\Api\ProjectApiController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 */

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('project', ProjectApiController::class)->names('project');
    Route::get('project/{project}/tasks', [ProjectApiController::class, 'tasks']);
    Route::post('project/{project}/tasks', [ProjectApiController::class, 'storeTask']);
});
