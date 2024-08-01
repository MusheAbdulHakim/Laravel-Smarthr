<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\ProjectController;
use Modules\Project\Http\Controllers\TaskBoardController;
use Modules\Project\Http\Controllers\ProjectTaskBoardController;

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

Route::group([], function () {
    Route::resource('task-boards', TaskBoardController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('project-list', [ProjectController::class,'list'])->name('projects.list');
    Route::get('project-taskboard/{id}', [ProjectTaskBoardController::class, 'board'])->name('project.taskboard');
    Route::get('project-tasks/{project}/create', [ProjectTaskBoardController::class, 'create'])->name('project-tasks.create');
    Route::post('project-tasks', [ProjectTaskBoardController::class, 'store'])->name('project-tasks.store');
    Route::get('project-tasks/{task}/edit', [ProjectTaskBoardController::class, 'edit'])->name('project-tasks.edit');
    Route::put('project-tasks/{task}/update', [ProjectTaskBoardController::class, 'update'])->name('project-tasks.update');
    Route::post('taskboard/update-task', [ProjectTaskBoardController::class, 'draggable'])->name('project-task.update-dragged');
    Route::delete('project-tasks/{task}/delete', [ProjectTaskBoardController::class, 'destroy'])->name('project-tasks.destroy');
    Route::delete('delete-project-file/{file}', [ProjectController::class, 'destroyProjectFile'])->name('project-file.destroy');
});
