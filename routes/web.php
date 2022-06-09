<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\GoalController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\AssetController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\PolicyController;
use App\Http\Controllers\Backend\BackupsController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\HolidayController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\GoalTypeController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LeaveTypeController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\DesignationController;
use App\Http\Controllers\Backend\FileManagerController;
use App\Http\Controllers\Backend\UserProfileController;
use App\Http\Controllers\Backend\EmployeeLeaveController;
use App\Http\Controllers\Backend\ChangePasswordController;
use App\Http\Controllers\Frontend\JobApplicationController;
use App\Http\Controllers\Backend\JobController as BackendJobController;

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
Route::group(['middleware'=>['guest']], function (){
    Route::get('register',[RegisterController::class,'index'])->name('register');
    Route::post('register',[RegisterController::class,'store']);
    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::post('login',[LoginController::class,'login']);

    Route::get('forgot-password',[ForgotPasswordController::class,'index'])->name('forgot-password');
    Route::post('forgot-password',[ForgotPasswordController::class,'reset']);

});

Route::get('job-list',[JobController::class,'index'])->name('job-list');
Route::get('job-view/{job}',[JobController::class,'show'])->name('job-view');
Route::post('apply',[JobApplicationController::class,'store'])->name('apply-job');


Route::group(['middleware'=>['auth']], function (){
    
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('logout',[LogoutController::class,'index'])->name('logout');

    //apps routes
    
    Route::get('contacts',[ContactController::class,'index'])->name('contacts');
    Route::post('contacts',[ContactController::class,'store']);
    Route::put('contacts',[ContactController::class,'update']);
    Route::delete('contacts',[ContactController::class,'destroy'])->name('contact.destroy');
    Route::get('file-manager',[FileManagerController::class,'index'])->name('filemanager');

    Route::get('holidays',[HolidayController::class,'index'])->name('holidays');
    Route::post('holidays',[HolidayController::class,'store']);
    Route::post('holidays/{holiday}',[HolidayController::class,'completed'])->name('completed');
    Route::put('holidays',[HolidayController::class,'update']);
    Route::delete('holidays',[HolidayController::class,'destroy'])->name('holiday.destroy');


    Route::get('departments',[DepartmentController::class,'index'])->name('departments');
    Route::post('departments',[DepartmentController::class,'store']);
    Route::put('departments',[DepartmentController::class,'update']);
    Route::delete('departments',[DepartmentController::class,'destroy'])->name('department.destroy');

    Route::get('designations',[DesignationController::class,'index'])->name('designations');
    Route::put('designations',[DesignationController::class,'update']);
    Route::post('designations',[DesignationController::class,'store']);
    Route::delete('designations',[DesignationController::class,'destroy'])->name('designation.destroy');

    // settings routes 
    Route::get('settings/theme',[SettingsController::class,'index'])->name('settings.theme');
    Route::post('settings/theme',[SettingsController::class,'updateTheme']);
    Route::get('settings/company',[SettingsController::class,'company'])->name('settings.company');
    Route::post('settings/company',[SettingsController::class,'updateCompany']);
    Route::get('settings/invoice',[SettingsController::class,'invoice'])->name('settings.invoice');
    Route::post('settings/invoice',[SettingsController::class,'updateInvoice']);
    Route::get('settings/attendance',[SettingsController::class,'attendance'])->name('settings.attendance');
    Route::post('settings/attendance',[SettingsController::class,'updateAttendance']);
    Route::get('change-password',[ChangePasswordController::class,'index'])->name('change-password');
    Route::post('change-password',[ChangePasswordController::class,'update']);

    Route::get('leave-type',[LeaveTypeController::class,'index'])->name('leave-type');
    Route::post('leave-type',[LeaveTypeController::class,'store']);
    Route::delete('leave-type',[LeaveTypeController::class,'destroy'])->name('leave-type.destroy');
    Route::put('leave-type',[LeaveTypeController::class,'update']);

    Route::get('policies',[PolicyController::class,'index'])->name('policies');
    Route::post('policies',[PolicyController::class,'store']);
    Route::delete('policies',[PolicyController::class,'destroy'])->name('policy.destroy');

    Route::get('clients',[ClientController::class,'index'])->name('clients');
    Route::post('clients',[ClientController::class,'store'])->name('client.add');
    Route::put('clients',[ClientController::class,'update'])->name('client.update');
    Route::delete('clients',[ClientController::class,'destroy'])->name('client.destroy');
    Route::get('clients-list',[ClientController::class,'lists'])->name('clients-list');

    Route::get('employees',[EmployeeController::class,'index'])->name('employees');
    Route::post('employees',[EmployeeController::class,'store'])->name('employee.add');
    Route::get('employees-list',[EmployeeController::class,'list'])->name('employees-list');
    Route::put('employees',[EmployeeController::class,'update'])->name('employee.update');
    Route::delete('employees',[EmployeeController::class,'destroy'])->name('employee.destroy');

    Route::get('employee-leave',[EmployeeLeaveController::class,'index'])->name('employee-leave');
    Route::post('employee-leave',[EmployeeLeaveController::class,'store']);
    Route::put('employee-leave',[EmployeeLeaveController::class,'update']);
    Route::delete('employee-leave',[EmployeeLeaveController::class,'destroy'])->name('leave.destroy');

    Route::get('jobs',[BackendJobController::class,'index'])->name('jobs');
    Route::post('jobs',[BackendJobController::class,'store']);
    Route::get('job-applicants',[BackendJobController::class,'applicants'])->name('job-applicants');
    Route::post('download-cv',[BackendJobController::class,'downloadCv'])->name('download-cv');

    Route::get('goal-type',[GoalTypeController::class,'index'])->name('goal-type');
    Route::post('goal-type',[GoalTypeController::class,'store']);
    Route::put('goal-type',[GoalTypeController::class,'update']);
    Route::delete('goal-type',[GoalTypeController::class,'destroy']);

    Route::get('goal-tracking',[GoalController::class,'index'])->name('goal-tracking');
    Route::post('goal-tracking',[GoalController::class,'store']);
    Route::put('goal-tracking',[GoalController::class,'update']);
    Route::delete('goal-tracking',[GoalController::class,'destroy']);

    Route::get('asset',[AssetController::class,'index'])->name('assets');
    Route::post('asset',[AssetController::class,'store']);
    Route::put('asset',[AssetController::class,'update']);
    Route::delete('asset',[AssetController::class,'destroy']);

    Route::get('users',[UserController::class,'index'])->name("users");
    Route::post('users',[UserController::class,'store']);
    Route::put('users',[UserController::class,'update']);
    Route::delete('users',[UserController::class,'destroy']);

    Route::get('profile',[UserProfileController::class,'index'])->name('profile');
    Route::post('profile',[UserProfileController::class,'update']);

    Route::get('activity',[ActivityController::class,'index'])->name('activity');
    Route::get('clear-activity',[ActivityController::class,'markAsRead'])->name('clear-all');

    Route::get('backups',[BackupsController::class,'index'])->name('backups');


});

Route::get('',function (){
    return redirect()->route('dashboard');
});


