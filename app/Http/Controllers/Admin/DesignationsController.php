<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DesignationDataTable;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DesignationDataTable $dataTable)
    {
        $pageTitle = __("Designations");
        return $dataTable->render('pages.designations.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.designations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Designation::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $notification = notify(__("Designation has been added"));
        return back()->with($notification);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        return view('pages.designations.edit',compact(
            'designation'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $designation->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $notification = notify(__("Designation has been updated"));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        $notification = notify(__("Designation has been deleted"));
        return back()->with($notification);
    }
}
