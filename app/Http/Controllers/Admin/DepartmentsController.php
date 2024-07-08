<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentDataTable;
use App\Http\Controllers\BaseController;

class DepartmentsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(DepartmentDataTable $dataTable)
    {
        $pageTitle = __('Departments');
        return $dataTable->render('pages.departments.index',compact(
            'pageTitle'
        ));
    }


    public function create(){
        return view('pages.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|max: 255'
        ]);

        Department::create([
            'name' => $request->name,
            'parent_department_id' => $request->parent,
            'location' => $request->location,
            'description' => $request->description
        ]);
        $notification = notify('Department has been added');
        return redirect()->route('departments.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function edit(Department $department)
    {
        return view('pages.departments.edit',compact(
            'department',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|max:255'
        ]);
        $department->update([
            'name' => $request->name,
            'parent_department_id' => $request->parent,
            'location' => $request->location,
            'description' => $request->description,
        ]);
        $notification = notify(__("Department has been updated"));
        return redirect()->route('departments.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        $notification = notify(__('Department has been deleted'));
        return redirect()->route('departments.index')->with($notification);
    }
}
