<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\AssetsController;
use App\Http\Controllers\Admin\ChatAppController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\HolidaysController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\FamilyInfoController;
use App\Http\Controllers\Admin\AttendancesController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\DesignationsController;
use App\Http\Controllers\Admin\EmployeeDetailsController;

include __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [UserProfileController::class, 'update']);

    Route::get('apps/chat', [ChatAppController::class, 'index'])->name('app.chat');

    Route::resource('users', UsersController::class);
    Route::resource('employees', EmployeesController::class);
    Route::resource('clients', ClientsController::class);
    Route::get('client-list', [ClientsController::class, 'list'])->name('clients.list');
    Route::get('employee/personal-info/{employeeDetail}', [EmployeeDetailsController::class, 'personalInfo'])->name('employee.personal-info');
    Route::post('employee/personal-info/{employeeDetail}', [EmployeeDetailsController::class, 'updatePersonalInfo']);
    Route::get('employee/emergency-contacts/{employeeDetail}', [EmployeeDetailsController::class, 'emergencyContacts'])->name('employee.emergency-contacts');
    Route::post('employee/emergency-contacts/{employeeDetail}', [EmployeeDetailsController::class, 'updateEmergencyContacts']);
    Route::get('employee/experience/{employeeDetail}', [EmployeeDetailsController::class, 'workExperience'])->name('employee.experience');
    Route::post('employee/experience/{employeeDetail}', [EmployeeDetailsController::class, 'updateWorkExperience']);
    Route::delete('delete-experience/{experience}', [EmployeeDetailsController::class, 'deleteWorkExperience'])->name('employee.experience.delete');
    Route::get('employee/education/{employeeDetail}', [EmployeeDetailsController::class, 'education'])->name('employee.education');
    Route::post('employee/education/{employeeDetail}', [EmployeeDetailsController::class, 'updateEducation']);
    Route::delete('del-employee-education', [EmployeeDetailsController::class, 'deleteEducation'])->name('employee.education.delete');

    Route::get('employees-list', [EmployeesController::class, 'list'])->name('employees.list');
    Route::resource('departments', DepartmentsController::class)->except(['show']);
    Route::resource('designations', DesignationsController::class)->except(['show']);
    Route::resource('holidays', HolidaysController::class);
    Route::get('holidays-calendar', [HolidaysController::class, 'calendar'])->name('holidays.calendar');
    Route::resource('family-information', FamilyInfoController::class);
    Route::resource('assets', AssetsController::class);
    Route::get('backups', fn() => view('pages.backups',[ 'pageTitle' => __('Backups')]))->name('backups.index');
    Route::get('attendance', [AttendancesController::class, 'index'])->name('attendances.index');
    Route::get('attendance-details/{attendance}', [AttendancesController::class, 'attendanceDetails'])->name('attendance.details');
    Route::resource('tickets', TicketsController::class);
    Route::get('assigned-tickets', [TicketsController::class, 'assignedTickets'])->name('assigned-tickets');
    Route::post('assign-ticket', [TicketsController::class, 'assignUser'])->name('ticket.assign-user');
    //settings
    Route::prefix('settings')->group(function () {
        Route::get('company', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('company', [SettingsController::class, 'updateCompany'])->name('settings.company.update');

        Route::get('locale', [SettingsController::class, 'locale'])->name('settings.locale');
        Route::post('locale', [SettingsController::class, 'updateLocale'])->name('settings.locale.update');
        Route::get('theme', [SettingsController::class, 'theme'])->name('settings.theme');
        Route::post('theme', [SettingsController::class, 'updateTheme'])->name('settings.theme.update');
        Route::get('invoice', [SettingsController::class, 'invoice'])->name('settings.invoice');
        Route::post('invoice', [SettingsController::class, 'updateInvoice'])->name('settings.invoice.update');
        Route::get('mail', [SettingsController::class, 'email'])->name('settings.mail');
        Route::post('mail', [SettingsController::class, 'updateEmail'])->name('settings.mail.update');
    });
});
