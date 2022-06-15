<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProvidentFund;
use App\Http\Controllers\Controller;

class ProvidentFundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'provident funds';
        $provident_funds = ProvidentFund::latest()->get();
        return view('backend.provident-funds',compact(
            'title','provident_funds'
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
            'employee' => 'required',
            'type' => 'required',
            'emp_amount' => 'required',
            'org_amount' => 'required',
            'emp_percent' => 'required',
            'org_percent' => 'required',
            'description' => 'required',
        ]);
        ProvidentFund::create([
            'employee_id' => $request->employee,
            'type' => $request->type,
            'employee_share_amount' => $request->emp_amount,
            'org_share_amount' => $request->org_amount,
            'employee_share_percent' => $request->emp_percent,
            'org_share_percent' => $request->org_percent,
            'description' => $request->description,
        ]);
        $notification = notify('provident fund has been added');
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
            'employee' => 'required',
            'type' => 'required',
            'emp_amount' => 'required',
            'org_amount' => 'required',
            'emp_percent' => 'required',
            'org_percent' => 'required',
            'description' => 'required',
        ]);
        $provident_fund = ProvidentFund::findOrFail($request->id);
        $provident_fund->update([
            'employee_id' => $request->employee,
            'type' => $request->type,
            'employee_share_amount' => $request->emp_amount,
            'org_share_amount' => $request->org_amount,
            'employee_share_percent' => $request->emp_percent,
            'org_share_percent' => $request->org_percent,
            'description' => $request->description,
        ]);
        $notification = notify('provident fund has been updated');
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
        ProvidentFund::findOrFail($request->id)->delete();
        $notification = notify('provident fund has been deleted');
        return back()->with($notification);
    }
}
