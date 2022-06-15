<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'taxes';
        $taxes = Tax::latest()->get();
        return view('backend.taxes',compact(
            'title','taxes'
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
            'name' => 'required',
            'percentage' => 'required',
            'status' => 'required'
        ]);
        Tax::create([
            'name' => $request->name,
            'percentage' => $request->percentage,
            'status' => $request->status,
        ]);
        $notification = notify('tax has been created');
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
            'name' => 'required',
            'percentage' => 'required',
            'status' => 'required'
        ]);
        $tax = Tax::findOrFail($request->id);
        $tax->update([
            'name' => $request->name,
            'percentage' => $request->percentage,
            'status' => $request->status,
        ]);
        $notification = notify('tax has been updated');
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
        Tax::findOrFail($request->id)->delete();
        $notification = notify('tax has been deleted');
        return back()->with($notification);
    }
}
