<?php

namespace App\Http\Controllers\Backend;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Designations";
        $designations = Designation::with('department')->get();
        $departments = Department::get();
        return view('backend.designations',compact('title','designations','departments'));
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
            'designation'=>'required|max:200',
            'department'=>'required',
        ]);
        Designation::create([
            'name'=>$request->designation,
            'department_id'=>$request->department,
        ]);
        return back()->with('success','Designation added successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $designation = Designation::find($request->id);
        $designation->delete();
        return back()->with('success',"Designation has been deleted successfully!!");
    }
}
