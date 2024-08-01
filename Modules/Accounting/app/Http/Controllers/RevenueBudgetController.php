<?php

namespace Modules\Accounting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Modules\Project\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Accounting\Models\Budget;
use Modules\Accounting\Models\RevenueBudget;
use Modules\Accounting\Models\BudgetCategory;

class RevenueBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Revenue Budgets');
        if($request->ajax()){
            $budgets = RevenueBudget::get();
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
                    return view('accounting::revenue-budget.actions',compact(
                        'id'
                    ));
                })
                ->rawColumns(['action','attachment'])
                ->make();
        }
        return view('accounting::revenue-budget.index',compact(
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
        return view('accounting::revenue-budget.create',compact(
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
            'startDate' => 'date|before_or_equal:endDate',
            'endDate' => 'date|after_or_equal:startDate'
        ]);
        $revenue = RevenueBudget::create([
            'title' => $request->title,
            'budget_id' => $request->budget,
            'budget_category_id' => $request->category,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'amount' => $request->amount,
            'note' => $request->note
        ]);
        if($request->hasFile('attachment')){
            $revenue->addMedia($request->attachment)->toMediaCollection('budget-attachments');
        }
        $notification = notify(__('Revenue budget has been created'));
        return back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RevenueBudget $budget_revenue)
    {
        $projects = Project::get();
        $categories = BudgetCategory::get();
        $budgets = Budget::get();
        $revenue = $budget_revenue;
        return view('accounting::revenue-budget.edit',compact(
            'revenue','projects','categories','budgets'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RevenueBudget $budget_revenue)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'startDate' => 'date|before_or_equal:endDate',
            'endDate' => 'date|after_or_equal:startDate'
        ]);
        $budget_revenue->update([
            'title' => $request->title,
            'budget_id' => $request->budget,
            'budget_category_id' => $request->category,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'amount' => $request->amount,
            'note' => $request->note
        ]);
        if($request->hasFile('attachment')){
            $budgetFile = $budget_revenue->getMedia('budget-attachments')->first();
            if(!empty($budgetFile)){
                $budgetFile->delete();
            }
            $budget_revenue->updateMedia($request->attachment,'budget-attachments');
        }   
        $notification = notify(__('Revenue budget has been deleted'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RevenueBudget $budget_revenue)
    {
        $budget_revenue->delete();
        $notification = notify(__("Revenue budget has been deleted"));
        return back()->with($notification);
    }
}
