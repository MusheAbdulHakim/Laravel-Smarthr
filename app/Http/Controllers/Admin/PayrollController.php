<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryGrades;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title="Salary Scales";
        $salaries = SalaryGrades::get();
        return view('backend.salaries.add_salary_scale',compact('salaries','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'salary_scale'=>'required|string|max:255',
            'salary_amount'=>'required|numeric',
            'salary_currency'=>'required|string'             
        ]);

        SalaryGrades::create([
            'salary_scale'=>$request->salary_scale,
            'salary_amount'=>$request->salary_amount,
            'salary_currency'=>$request->salary_currency
            
        ]);
        return back()->with('success',"Salary Scale has been added successfully!!");
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function delete(Request $request)
    {
        //
        $client=SalaryGrades::findOrFail($request->id);
        $client->delete();
        return back()->with('success',"Salary Grade has been deleted successfully!!");
    }
}
