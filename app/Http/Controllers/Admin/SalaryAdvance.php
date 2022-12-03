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


        // Check if the employee is having any Active Loan first
        $check_salary_advance_active_loan = cashadvance::where('employee_id',"=",$request->employee_id)->where('loan_status',"=",1)->exists(); 
        if($check_salary_advance_active_loan){
            return back()->with('warnings', "This employee is having an active loan!!");    
        }


        // Otherwise Proceed
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
        $this->validate($request, [
            'title' => 'required|string',
            'date' => 'required',
			'rate_amount' => 'required|numeric',
            'total_repayments' => 'required|numeric',
            'duration' => 'required|numeric',
			'emi' => 'required|numeric',
            'employee_id' => 'required|string'
        ]);

// Only Update Current Active/Pending Loan 
        $new_salary_advance = cashadvance::where('employee_id',"=",$request->employee_id)->latest()->first(); 
        $new_salary_advance->update([
            'employee_id' => $request->employee_id,
            'rate_amount' => $request->rate_amount,            
            'date' => $request->date,
            'total_repayments' => $request->total_repayments,
            'duration' => $request->duration,
            'emi' => $request->emi,
            'loan_status' => $request->status,
            'title' => $request->title
           

        ]);
        return back()->with('success', "Salary Advance has been updated successfully!!");
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
        $client=cashadvance::findOrFail($request->id);
        $client->delete();
        return back()->with('success', "Salary Advance has been removed successfully!!");
    }
}
