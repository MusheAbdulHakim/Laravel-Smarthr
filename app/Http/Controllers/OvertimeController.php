<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'overtime';
        $overtimes = Overtime::get();
        return view('backend.employee-overtime',compact(
            'title','overtimes'
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
            'hours' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);
        Overtime::create([
            'employee_id' => $request->employee,
            'overtime_date' => $request->date,
            'hours' => $request->hours,
            'description' => $request->description,
        ]);
        $notification = notify('overtime has been added');
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
            'hours' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);
        $overtime = OverTime::findOrfail($request->id);
        $overtime->update([
            'employee_id' => $request->employee,
            'overtime_date' => $request->date,
            'hours' => $request->hours,
            'description' => $request->description,
            'approved_by' => auth()->user()->id,
        ]);
        $notification = notify('overtime has been updated');
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
        OverTime::findOrfail($request->id)->delete();
        $notification = notify('overtime has been added');
        return back()->with($notification);
    }
}
