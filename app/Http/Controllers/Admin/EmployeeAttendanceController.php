<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Settings\AttendanceSettings;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'employee attendance';
        $attendances = EmployeeAttendance::latest()->get();
        return view('backend.attendance',compact(
            'title','attendances'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'employee' => 'required',
            'checkin' => 'required',
        ]);
        $settings = new AttendanceSettings();
        $time = date('H:i');
        $min_checkin_time = strtotime($settings->checkin_time) + 1800;
        if($request->checkin){
            if($time < $settings->checkin_time){
                $status = 'early';
            }if($time <= date('H:i',$min_checkin_time)){
                $status = 'ontime';
            }else{
                $status = 'late';
            }
        }
            
        EmployeeAttendance::create([
            'employee_id' => $request->employee,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => $status,
        ]);
        $notification = notify('employee attendance has been created');
        return back()->with($notification);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'employee' => 'required',
            'checkin' => 'required',
        ]);
        $settings = new AttendanceSettings();
        $time = date('H:i');
        $min_checkin_time = strtotime($settings->checkin_time) + 1800;
        if($request->checkin){
            if($time < $settings->checkin_time){
                $status = 'early';
            }if($time <= date('H:i',$min_checkin_time)){
                $status = 'ontime';
            }else{
                $status = 'late';
            }
        }
        if($request->checkout){
            if($time < $settings->checkout_time){
                $status = 'early';
            }if($time >= date('H:i',$min_checkin_time)){
                $status = 'ontime';
            }else{
                $status = 'overtime';
            }
        }   
        $attendance = EmployeeAttendance::findOrFail($request->id);
        $attendance->update([
            'employee_id' => $request->employee,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => $status,
        ]);
        $notification = notify('employee attendance has been updated');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        EmployeeAttendance::findOrFail($request->id)->delete();
        $notification = notify('employee attendance has been deleted');
        return back()->with($notification);
    }
}
