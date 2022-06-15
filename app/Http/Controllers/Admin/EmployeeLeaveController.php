<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "employee leave";
        $leaves = Leave::with('leaveType','employee')->get();
        $leave_types = LeaveType::get();
        $employees = Employee::get();
        return view('backend.employee-leaves',compact(
            'title','leaves','leave_types','employees'
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
            'employee'=>'required',
            'leave_type'=>'required',
            'from'=>'required',
            'to'=>'required',
            'reason'=>'required'
        ]);
        Leave::create([
            'employee_id'=>$request->employee,
            'leave_type_id'=>$request->leave_type,
            'from'=>$request->from,
            'to'=>$request->to,
            'reason'=>$request->reason,
            'status' =>$request->status,
        ]);
        $notification = notify("Employee leave has been added");
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
        $leave = Leave::find($request->id);
        $leave->update([
            'employee_id'=>$request->employee,
            'leave_type_id'=>$request->leave_type,
            'from'=>$request->from,
            'to'=>$request->to,
            'reason'=>$request->reason,
            'status' => $request->status,
        ]);
        $notification = notify("Employee leave has been updated");;
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $leave = Leave::find($request->id);
        $leave->delete();
        $notification = notify('Employee leave has been deleted');
        return back()->with($notification);
    }
}
