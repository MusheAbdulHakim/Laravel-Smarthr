<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use App\Models\AttendanceTimestamp;
use Illuminate\Support\Facades\Crypt;

class EmployeeAttendance extends Component
{
    public $forProject,$project, $clockedIn, $timeStarted;
    public $totalHours = 0;
    public $timeId = null;
    public $attendances, $todayActivity;
    
    public $totalHoursToday;
    public $totalHoursThisMonth;
    public $totalHoursThisWeek;

    public function clockin()
    {
        try{

            $user  = auth()->user();
            if($this->forProject){
                $this->validate([
                    'project' => 'required',
                ]);
            }
            $todayAttendance = Attendance::where('user_id', $user->id)
                    ->whereDate('created_at', Carbon::today())->first();
            if(!empty($todayAttendance)){
                $attendance = $todayAttendance;
            }else{
                $attendance = Attendance::create([
                    'user_id' => $user->id,
                    'startDate' => now(),
                    'endDate' => null,
                ]);
            }
            AttendanceTimestamp::create([
                'user_id' => $user->id,
                'attendance_id' => $attendance->id,
                'project_id' => $this->project,
                'startTime' => now(),
                'endTime' => null,
                'location' => $user->employeeDetail->department->location ?? null,
                'billable' => false,
                'ip' => request()->ip() ?? null,
            ]);
            $this->dispatch('IsClockedIn');
            $this->dispatch('refreshAttendance');
            $this->dispatch('Notification',__('You have clockin successfully'));
            $this->js("bootstrap.Modal.getInstance(document.getElementById('clockin_modal')).hide()");
        }catch(\Exception $e){
            $this->dispatch('Notification',__('Something went wrong'));
        }
    }

    public function clockout($timestampId)
    {
        try{
            $timestamp = AttendanceTimestamp::find(Crypt::decrypt($timestampId));
            $timestamp->attendance->update([
                'endDate' => now(),
            ]);
            $timestamp->update([
                'endTime' => now(),
            ]);
            $this->dispatch('IsClockedIn');
            $this->dispatch('refreshAttendance');
            $this->dispatch('Notification',__('You have clockout successfully'));
        }catch(\Exception $e){
            $this->dispatch('Notification',__('Something went wrong'));
        }
    }

   
    #[On('refreshAttendance')]
    public function getAttendance()
    {
        $userId = auth()->user()->id;
        $attendances = AttendanceTimestamp::where('user_id', $userId)
                    ->whereNotNull('attendance_id');
        $this->attendances = $attendances->get();
        $this->todayActivity = $attendances->whereDate('created_at', Carbon::today())->get();
        
    }

    #[On('fetchStatistics')]
    public function statistics()
    {
        $userId = auth()->user()->id;
        $userAttendances = AttendanceTimestamp::where('user_id', $userId)
                        ->whereNotNull('attendance_id');
        $this->totalHoursToday = $userAttendances->whereDate('created_at', Carbon::today())
                        ->get()
                        ->sum('totalHours');
        $this->totalHoursThisMonth = $userAttendances->whereMonth('created_at', Carbon::now())
                        ->get()
                        ->sum('totalHours');
        $this->totalHoursThisWeek = $userAttendances
                        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->get()
                        ->sum('totalHours');
    }

    #[On('IsClockedIn')]
    public function getClockInData()
    {
        $todayClockin = Attendance::where('user_id', auth()->user()->id)
                    ->whereDate('created_at', Carbon::today())
                    ->first();
        if(!empty($todayClockin)){
            $latestClockin = $todayClockin->timestamps()->latest()->whereNull('endTime')->first() ?? null;
            if(!empty($latestClockin)){
                $this->clockedIn = true;
                $this->timeId = Crypt::encrypt($latestClockin->id);
                $this->timeStarted = $latestClockin->startTime;
                $this->totalHours = Carbon::now()->diff($latestClockin->startTime)->h;
            }
        }
    }
   
    public function render()
    {
        return view('livewire.employee-attendance');
    }
    
}
