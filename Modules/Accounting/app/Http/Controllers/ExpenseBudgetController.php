<?php

namespace Modules\Accounting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Modules\Project\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Accounting\Models\Budget;
use App\Http\Controllers\BaseController;
use Modules\Accounting\Models\ExpenseBudget;
use Modules\Accounting\Models\BudgetCategory;

class ExpenseBudgetController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Expense Budgets');
        if($request->ajax()){
            $budgets = ExpenseBudget::get();
            return DataTables::of($budgets)
                ->addIndexColumn()
                ->addColumn('category', function($row){
                    return $row->category->name ?? '';
                })
                ->addColumn('budget', function($row){
                    return $row->budget->title ?? '';
                })
                ->addColumn('amount', function($row){
                    return LocaleSettings('currency_symbol').$row->amount ?? '';
                })
                ->addColumn('startDate', function($row){
                    return format_date($row->startDate) ?? '';
                })
                ->addColumn('endDate', function($row){
                    return format_date($row->endDate) ?? '';
                })
                ->addColumn('attachment', function($row){
                    $attachment = $row->getMedia('budget-attachments')->first();
                    if(!empty($attachment)){
                        return '<a download="'.$attachment->file_name.'" href="'. $attachment->getFullUrl() .'">'.$attachment->file_name.'</a>';
                    }
                })
                ->addColumn('action',function ($row){
                    $id = $row->id;
                    return view('accounting::expense-budget.actions',compact(
                        'id'
                    ));
                })
                ->rawColumns(['action','attachment'])
                ->make();
        }
        return view('accounting::expense-budget.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::get();
        $categories = BudgetCategory::get();
        $budgets = Budget::get();
        return view('accounting::expense-budget.create',compact(
            'projects','categories','budgets'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'startDate' => 'required|date|before_or_equal:endDate',
            'endDate' => 'date|after_or_equal:startDate'
        ]);
        $expense = ExpenseBudget::create([
            'title' => $request->title,
            'budget_id' => $request->budget,
            'budget_category_id' => $request->category,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'amount' => $request->amount,
            'note' => $request->note
        ]);
        if($request->hasFile('attachment')){
            $expense->addMedia($request->attachment)->toMediaCollection('budget-attachments');
        }
        $notification = notify(__('Expense budget has been created'));
        return back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseBudget $budget_expense)
    {
        $projects = Project::get();
        $categories = BudgetCategory::get();
        $budgets = Budget::get();
        $expense = $budget_expense;
        return view('accounting::expense-budget.edit',compact(
            'expense','projects','categories','budgets'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpenseBudget $budget_expense)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'startDate' => 'date|before_or_equal:endDate',
            'endDate' => 'date|after_or_equal:startDate'
        ]);
        $budget_expense->update([
            'title' => $request->title,
            'budget_id' => $request->budget,
            'budget_category_id' => $request->category,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'amount' => $request->amount,
            'note' => $request->note
        ]);
        if($request->hasFile('attachment')){
            $budgetFile = $budget_expense->getMedia('budget-attachments')->first();
            if(!empty($budgetFile)){
                $budgetFile->delete();
            }
            $budget_expense->addMedia($request->attachment)->toMediaCollection('budget-attachments');
        }   
        $notification = notify(__('Expense budget has been deleted'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseBudget $budget_expense)
    {
        $budget_expense->delete();
        $notification = notify(__("Expense budget has been deleted"));
        return back()->with($notification);
    }
}
