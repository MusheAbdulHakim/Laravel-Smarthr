<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\SalaryAdvance as cashadvance;


class SalaryAdvance extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.salary_advance.salary_advance',[
            'title' => 'Salary Advance Loans',
            'salary_advances' => cashadvance::get(),
            'employees' => Employee::get()
        ]);
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
        $this->validate($request, [
            'title' => 'required|string',
            'date' => 'required',
			'rate_amount' => 'required|numeric',
            'total_repayments' => 'required|numeric',
            'duration' => 'required|numeric',
			'emi' => 'required|numeric',
            'employee_id' => 'required|string'
        ]);

        cashadvance::create([
            'employee_id' => $request->employee_id,
            'rate_amount' => $request->rate_amount,            
            'date' => $request->date,
            'total_repayments' => $request->total_repayments,
            'duration' => $request->duration,
            'emi' => $request->emi,
            'loan_status' => $request->status,
            'title' => $request->title
           

        ]);
        return back()->with('success', "Salary Advance has been added successfully!!");
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
    public function destroy(Request $request)
    {
        //
        $client=cashadvance::findOrFail($request->id);
        $client->delete();
        return back()->with('success', "Salary Advance has been removed successfully!!");
    }
}
