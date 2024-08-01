<?php

namespace Modules\Accounting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Sales\Models\Tax;
use Yajra\DataTables\DataTables;
use Modules\Project\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Accounting\Models\Budget;
use Modules\Accounting\Models\ExpenseBudget;
use Modules\Accounting\Models\RevenueBudget;
use Modules\Accounting\Models\BudgetCategory;

class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Budgets');
        if($request->ajax()){
            $budgets = Budget::get();
            return DataTables::of($budgets)
                ->addIndexColumn()
                ->addColumn('type', function($row){
                    $type = $row->type;
                    $name = '';
                    if($type == 'category'){
                        $name = 'Category: '.$row->category->name ?? '';
                    }  
                    if($type == 'project'){
                        $name = 'Project: '.$row->project->name ?? '';
                    }
                    return ucwords($name) ?? '';
                })
                ->addColumn('amount', function($row){
                    return LocaleSettings('currency_symbol').$row->amount ?? '';
                })
                ->addColumn('revenue', function($row){
                    return LocaleSettings('currency_symbol').$row->total_revenue ?? '';
                })
                ->addColumn('expenses', function($row){
                    return LocaleSettings('currency_symbol').$row->total_expense ?? '';
                })
                ->addColumn('startDate', function($row){
                    return format_date($row->startDate) ?? '';
                })
                ->addColumn('endDate', function($row){
                    return format_date($row->endDate) ?? '';
                })
                ->addColumn('attachment', function($row){
                    $attachment = $row->getMedia('budget-files')->first();
                    if(!empty($attachment)){
                        return '<a download="'.$attachment->file_name.'" href="'. $attachment->getFullUrl() .'">'.$attachment->file_name.'</a>';
                    }
                })
                ->addColumn('action',function ($row){
                    $id = $row->id;
                    return view('accounting::budgets.actions',compact(
                        'id'
                    ));
                })
                ->rawColumns(['action','attachment'])
                ->make();
        }
        return view('accounting::budgets.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BudgetCategory::get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('accounting::budgets.create',compact(
            'categories','projects','taxes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required',
            'budget_amount' => 'required',
            'startDate' => 'date|before_or_equal:endDate',
            'endDate' => 'date|after_or_equal:startDate',
            'note' => 'string|max:255',
            'revenues.*' => 'required',
            'expenses.*' => 'required',
        ]);
        $budget = Budget::create([
            'title' => $request->title,
            'type' => $request->type,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate, 
            'total_revenue' => $request->overall_revenues,
            'total_expense' => $request->overall_expenses,
            'profit' => $request->expected_profit,
            'budget_category_id' => $request->category,
            'project_id' => $request->project,
            'taxes' => $request->tax,
            'amount' => $request->budget_amount,
            'note' => $request->note
        ]);
        if(!empty($request->expenses)){
            foreach($request->expenses as $item){
                ExpenseBudget::create([
                    'title' => $item['title'],
                    'amount' => $item['amount'],
                    'budget_id' => $budget->id,
                    'budget_category_id' => $budget->budget_category_id,
                    'startDate' => $budget->startDate,
                    'endDate' => $budget->endDate,
                ]);
            }
        }
        if(!empty($request->revenues)){
            foreach($request->revenues as $item){
                RevenueBudget::create([
                    'title' => $item['title'],
                    'amount' => $item['amount'],
                    'budget_id' => $budget->id,
                    'budget_category_id' => $budget->budget_category_id,
                    'startDate' => $budget->startDate,
                    'endDate' => $budget->endDate,
                ]);
            }
        }
        if($request->hasFile('attachment')){
            $budget->addMedia($request->attachment)->toMediaCollection('budget-files');
        }
        $notification = notify(__('Budget has been added'));
        return back()->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('accounting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        $categories = BudgetCategory::get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('accounting::budgets.edit',compact(
            'categories','projects','taxes','budget'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required',
            'budget_amount' => 'required',
            'startDate' => 'date|before_or_equal:endDate',
            'endDate' => 'date|after_or_equal:startDate',
            'note' => 'string|max:255',
            'revenues.*' => 'required',
            'expenses.*' => 'required',
        ]);
        $budget->update([
            'title' => $request->title,
            'type' => $request->type,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate, 
            'total_revenue' => $request->overall_revenues,
            'total_expense' => $request->overall_expenses,
            'profit' => $request->expected_profit,
            'budget_category_id' => $request->category,
            'project_id' => $request->project,
            'taxes' => $request->tax,
            'amount' => $request->budget_amount,
            'note' => $request->note
        ]);
        $expenses = $request->expenses;
        if(!empty($request->expenses)){
            RevenueBudget::whereNotIn('id',collect($expenses)->pluck('id')->all())->delete();
            foreach($expenses as $item){
                ExpenseBudget::updateOrCreate([
                    'id' => $item['id'],
                    'budget_id' => $budget->id,
                ], [
                    'title' => $item['title'],
                    'amount' => $item['amount'],
                    'budget_id' => $budget->id,
                    'budget_category_id' => $budget->budget_category_id,
                    'startDate' => $budget->startDate,
                    'endDate' => $budget->endDate,
                ]);
            }
        }
        $revenue = $request->revenues;
        if(!empty($revenue)){
            RevenueBudget::whereNotIn('id',collect($revenue)->pluck('id')->all())->delete();
            foreach($revenue as $item){
                RevenueBudget::updateOrCreate([
                    'id' => $item['id'],
                    'budget_id' => $budget->id
                ],[
                    'title' => $item['title'],
                    'amount' => $item['amount'],
                    'budget_id' => $budget->id,
                    'budget_category_id' => $budget->budget_category_id,
                    'startDate' => $budget->startDate,
                    'endDate' => $budget->endDate,
                ]);
            }
        }
        if($request->hasFile('attachment')){
            $budgetFile = $budget->getMedia('budget-files')->first();
            if(!empty($budgetFile)){
                $budgetFile->delete();
            }
            $budget->addMedia($request->attachment)->toMediaCollection('budget-files');
        }
        $notification = notify(__('Budget has been updated'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        $notification = notify(__('Budget has been deleted'));
        return back()->with($notification);
    }
}
