<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Sales\Models\Tax;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Taxes');
        if($request->ajax()){
            $taxes = Tax::get();
            return DataTables::of($taxes)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return $row->active == true ? __('Active'): __('InActive');
                })
                ->addColumn('action',function ($row){
                    $id = $row->id;
                    return view('sales::taxes.actions',compact(
                        'id'
                    ));
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('sales::taxes.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales::taxes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'percentage' => 'required|numeric',
            'status' => 'required'
        ]);
        Tax::create([
            'name' => $request->name,
            'percentage' => $request->percentage,
            'active' => $request->status
        ]);
        $notification = notify(__('Tax has been added'));
        return back()->with($notification);
    }

    /**
     * Show the specified resource.
     */

     public function show(Tax $tax){
        return response()->json(['tax' => $tax]);
     }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tax $tax)
    {
        return view('sales::taxes.edit',compact(
            'tax'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'name' => 'required',
            'percentage' => 'required|numeric',
            'status' => 'required'
        ]);
        $tax->update([
            'name' => $request->name,
            'percentage' => $request->percentage,
            'active' => $request->status
        ]);
        $notification = notify(__('Tax has been updated'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        $notification = notify(__('Tax has been deleted'));
        return back()->with($notification);
    }
}
