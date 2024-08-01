<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserType;
use Carbon\CarbonPeriod;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AttendancesController extends Controller
{
    
    public function index(Request $request){

        $pageTitle = __('Attendances');

        $selectedMonth = $request->month ?? Carbon::now()->month;
        $selectedYear = $request->year ?? Carbon::now()->year;

        $years_range = CarbonPeriod::create(now()->subYears(10), Carbon::now()->addYears(10))->years();
        $days_in_month = Carbon::createFromDate($selectedYear, $selectedMonth,01)->daysInMonth;
        $users = User::with(['attendances' => function ($query) use ($selectedMonth,$selectedYear) {
            $query->whereMonth('created_at', $selectedMonth)
                ->whereYear('created_at', $selectedYear)
                ->orderBy('created_at', 'desc')
                ->take(1);
        }])->where('type', UserType::EMPLOYEE);
        if(!empty($request->employee)){
            $users = $users->where('email','LIKE','%'.$request->employee.'%')
                        ->orWhere('firstname','LIKE','%'.$request->employee.'%')
                        ->orWhere('middlename','LIKE','%'.$request->employee.'%')
                        ->orWhere('lastname','LIKE','%'.$request->employee.'%')
                        ->orWhere('username','LIKE','%'.$request->employee.'%');
        }
        $employees = $users->get();
        return view('pages.attendances.index',compact(
            'pageTitle','employees','years_range','days_in_month'
        ));
    }

    public function attendanceDetails(Request $request, Attendance $attendance)
    {
        $attendanceActivity = $attendance->timestamps()->get();
        $totalHours = $attendance->timestamps()->get()->sum('totalHours');
        return view('pages.attendances.attendance-details',compact(
            'attendance','totalHours','attendanceActivity'
        ));
    }
}
