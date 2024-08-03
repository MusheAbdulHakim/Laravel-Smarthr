<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use App\Models\EmployeeDeduction;

class DeductionsController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = __('Deductions');
        $deductions = EmployeeDeduction::get();
        return view('pages.payroll.deductions.index',compact(
            'pageTitle','deductions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::where('type', UserType::EMPLOYEE)
            ->whereHas('employeeDetail')
            ->where('is_active', true)->get();
        return view("pages.payroll.deductions.create",compact(
            'employees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
        ]);

        EmployeeDeduction::create([
            'employee_detail_id' => $request->employee, 
            'name' => $request->name,
            'amount' => $request->amount, 
        ]);
        $notification = notify(__('Deduction has been added'));
        return back()->with($notification);
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeDeduction $deduction)
    {
        $employees = User::where('type', UserType::EMPLOYEE)
            ->whereHas('employeeDetail')
            ->where('is_active', true)->get();
        return view("pages.payroll.deductions.edit",compact(
            'employees','deduction'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeDeduction $deduction)
    {
        $deduction->update([
            'employee_detail_id' => $request->employee ?? $deduction->employee_detail_id, 
            'name' => $request->name ?? $deduction->name,
            'amount' => $request->amount ?? $deduction->amount, 
        ]);
        $notification = notify(__('Deduction has been updated'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeDeduction $deduction)
    {
        $deduction->delete();
        $notification = notify(__('Deduction has been deleted'));
        return back()->with($notification);
    }
}
