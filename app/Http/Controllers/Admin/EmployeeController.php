<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Employee,Department,Designation,SalaryGrades,Salaries};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="employees";
        $salary_scales = SalaryGrades::get();
        $designations = Designation::get();
        $departments = Department::get();
        $employees = Employee::with('department','designation')->get();
        return view('backend.employees',
        compact('title','designations','departments','employees','salary_scales'));
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function list()
   {
       $title="employees";
       $designations = Designation::get();
       $departments = Department::get();
       $employees = Employee::with('department','designation')->get();
       return view('backend.employees-list',
       compact('title','designations','departments','employees'));
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
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone'=>'nullable|max:15',
            'company'=>'required|max:200',
            'avatar'=>'file|image|mimes:jpg,jpeg,png,gif',
            'department'=>'required',
            'designation'=>'required',
            'salary_scale'=>'required|string',
            'housing_allowance'=>'nullable|numeric',
            'transport_allowance'=>'nullable|numeric',
            'lunch_allowance'=>'nullable|numeric',
        ]);
        $imageName = Null;
        if ($request->hasFile('avatar')){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/employees'), $imageName);
        }
        $uuid = IdGenerator::generate(['table' => 'employees','field'=>'uuid', 'length' => 7, 'prefix' =>'EMP-']);
        Employee::create([
            'uuid' =>$uuid,
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company'=>$request->company,
            'department_id'=>$request->department,
            'designation_id'=>$request->designation,
            'avatar'=>$imageName,
        ]);

        // Salary Data
        $created_employee = Employee::where('email',"=",$request->email)->firstOrFail();
        $salary_data = SalaryGrades::findOrFail($request->salary_scale);
        Salaries::create([
            'employee_id' =>$created_employee->id,
            'salary_scale'=>$salary_data->salary_scale,
            'salary_amount'=>$salary_data->salary_amount,
            'housing_allowance'=>is_null($request->housing_allowance) ? 0 : $request->housing_allowance,
            'transport_allowance'=>is_null($request->transport_allowance) ? 0 : $request->transport_allowance,
            'lunch_allowance'=>is_null($request->lunch_allowance) ? 0 : $request->lunch_allowance           
        ]);


        return back()->with('success',"Employee has been added");
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
    public function update(Request $request)
    {
        
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone'=>'nullable|max:15',
            'company'=>'required|max:200',
            'avatar'=>'file|image|mimes:jpg,jpeg,png,gif',
            'department'=>'required',
            'designation'=>'required',
            'salary_scale'=>'required|string',
            'housing_allowance'=>'nullable|numeric',
            'transport_allowance'=>'nullable|numeric',
            'lunch_allowance'=>'nullable|numeric',
        ]);
        if ($request->hasFile('avatar')){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/employees'), $imageName);
        }else{
            $imageName = Null;
        }
        
        $employee = Employee::findOrFail($request->id);
        $employee->update([
            'uuid' => $employee->uuid,
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company'=>$request->company,
            'department_id'=>$request->department,
            'designation_id'=>$request->designation,
            'avatar'=>$imageName,
            
        ]);


 // Salary Data
  // Salary Data
  
  $salary_data = Salaries::findOrFail($request->salary_scale);
  $salary_data->update([
      'employee_id' => $employee->id,
      'salary_scale'=>$salary_data->salary_scale,
      'salary_amount'=>$salary_data->salary_amount,
      'housing_allowance'=>is_null($request->housing_allowance) ? 0 : $request->housing_allowance,
      'transport_allowance'=>is_null($request->transport_allowance) ? 0 : $request->transport_allowance,
      'lunch_allowance'=>is_null($request->lunch_allowance) ? 0 : $request->lunch_allowance           
  ]);

         return back()->with('success',"Employee details has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->delete();
        return back()->with('success',"Employee has been deleted");
    }
}
