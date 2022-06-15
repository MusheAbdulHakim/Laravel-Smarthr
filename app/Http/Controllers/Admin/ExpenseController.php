<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'expenses';
        $expenses = Expense::get();
        return view('backend.expenses',compact(
            'title','expenses'
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
            'user' => 'required',
            'seller' => 'required',
            'date' => 'nullable',
            'payment_method' => 'required',
            'amount' => 'required',
            'file' => 'nullable|file',
            'status' => 'required'
        ]);
        $file_name = null;
        if($request->hasFile('file')){
            $file_name = time().'.'.$request->file->extension();
            $request->file->move(public_path('storage/expenses'), $file_name);
        }
        Expense::create([
            'name' => $request->name,
            'user_id' => $request->user ?? auth()->user()->id,
            'purchased_from' => $request->seller,
            'purchased_date' => $request->date,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'file' => $file_name,
            'status' => $request->status ?? 'Approved',
        ]);
        $notification = notify('expense has been created');
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
            'user' => 'required',
            'seller' => 'required',
            'date' => 'nullable',
            'payment_method' => 'required',
            'amount' => 'required',
            'file' => 'nullable|file',
            'status' => 'required'
        ]);
        $expense = Expense::findOrFail($request->id);
        $file_name = $expense->file;
        if($request->hasFile('file')){
            $file_name = time().'.'.$request->file->extension();
            $request->file->move(public_path('storage/expenses'), $file_name);
        }
        $expense->update([
            'name' => $request->name,
            'user_id' => $request->user ?? auth()->user()->id,
            'purchased_from' => $request->seller,
            'purchased_date' => $request->date,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'file' => $file_name,
            'status' => $request->status ?? 'Approved',
        ]);
        $notification = notify('expense has been updated');
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
        Expense::findOrFail($request->id)->delete();
        $notification = notify('expense has been deleted');
        return back()->with($notification);
    }
}
