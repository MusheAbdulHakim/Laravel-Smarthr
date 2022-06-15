<?php

namespace App\Http\Controllers\Admin;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Assets";
        $assets = Asset::get();
        return view('backend.assets',compact(
            'title','assets'
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
            'name' => 'required|max:200',
            'purchase_date' => 'required|date',
            'purchase_from' => 'required',
            'manufacturer' => 'required',
            'model' => 'nullable|max:100',
            'serial_number' => 'nullable|max:50',
            'supplier' => 'required|max:200',
            'condition' => 'nullable|max:200',
            'warranty' => 'required|integer',
            'value' => 'required',
            'status' => 'required',
            'description' => 'nullable|max:255'
        ]);
        
        Asset::create([
            'name' => $request->name,
            'purchase_date' => $request->purchase_date,
            'purchase_from' => $request->purchase_from,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'supplier' => $request->supplier,
            'condition' => $request->condition,
            'warranty' => $request->warranty,
            'value' => $request->value,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return back()->with('success',"Asset has been added!!");
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:200',
            'purchase_date' => 'required|date',
            'purchase_from' => 'required',
            'manufacturer' => 'required',
            'model' => 'nullable|max:100',
            'serial_number' => 'nullable|max:50',
            'supplier' => 'required|max:200',
            'condition' => 'nullable|max:200',
            'warranty' => 'required|integer',
            'value' => 'required',
            'status' => 'required',
            'description' => 'nullable|max:255'
        ]);
        $asset = Asset::findOrFail($request->id);
        $asset->update([
            'uuid' => $request->uuid,
            'name' => $request->name,
            'purchase_date' => $request->purchase_date,
            'purchase_from' => $request->purchase_from,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'supplier' => $request->supplier,
            'condition' => $request->condition,
            'warranty' => $request->warranty,
            'value' => $request->value,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return back()->with('success',"Asset has been updated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $requst)
    {
        $asset = Asset::findOrFail($request->id);
        $asset->delete();
        return back()->with('success',"Asset has been deleted!!!");
    }
}
