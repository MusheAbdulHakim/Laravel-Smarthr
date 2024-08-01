<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Modules\Sales\Models\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Expenses');
        if($request->ajax()){
            $expenses = Expense::get();
            return DataTables::of($expenses)
                ->addIndexColumn()
                ->editColumn('purchase_date', function($row){
                    return format_date($row->purchase_date) ?? '';
                })  
                ->editColumn('amount', function($row){
                    return LocaleSettings('currency_symbol').$row->amount;
                })
                ->addColumn('paid_by', function($row){
                    $method = $row->paid_by;
                    if($method == '1'){
                        $name = __('Cash');
                    }
                    if($method == '2'){
                        $name = __('Cheque');
                    }
                    if($method == '3'){
                        $name = __('Card');
                    }
                    return $name;
                })
                ->addColumn('status', function($row){
                    return $row->status == true ? __('Approved'): __('Pending');
                })
                ->addColumn('action',function ($row){
                    $id = $row->id;
                    return view('sales::expenses.actions',compact(
                        'id'
                    ));
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('sales::expenses.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales::expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'purchase_from' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'paid_by' => 'required',
        ]);
        Expense::create([
            'item_name' => $request->item_name,
            'purchased_from' => $request->purchase_from,
            'purchase_date' => $request->purchase_date ?? now(),
            'amount' => $request->amount,
            'status' => $request->status,
            'paid_by' => $request->paid_by,
            'created_by' => auth()->user()->id
        ]);
        $notification = notify(__("Expense has been created"));
        return back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('sales::expenses.edit',compact(
            'expense'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'item_name' => 'required',
            'purchase_from' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'paid_by' => 'required',
        ]);
        $expense->update([
            'item_name' => $request->item_name,
            'purchased_from' => $request->purchase_from,
            'purchase_date' => $request->purchase_date ?? now(),
            'amount' => $request->amount,
            'status' => $request->status,
            'paid_by' => $request->paid_by,
            'created_by' => auth()->user()->id
        ]);
        $notification = notify(__("Expense has been updated"));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        $notification = notify(__('Expense has been deleted'));
        return back()->with($notification);
    }
}
