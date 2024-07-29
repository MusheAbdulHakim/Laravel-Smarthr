<?php

namespace Modules\Accounting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Accounting\Models\BudgetCategory;

class BudgetCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Budget Category');
        if($request->ajax()){
            $categories = BudgetCategory::get();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action',function ($row){
                    $id = $row->id;
                    return view('accounting::categories.actions',compact(
                        'id'
                    ));
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('accounting::categories.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounting::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        BudgetCategory::create([
            'name' => $request->name
        ]);
        $notification = notify(__("Budget category has been created"));
        return back()->with($notification);
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BudgetCategory $category)
    {
        return view('accounting::categories.edit',compact(
            'category'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BudgetCategory $category)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category->update([
            'name' => $request->name
        ]);
        $notification = notify(__('Budget category has been updated'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BudgetCategory $category)
    {
        $category->delete();
        $notification = notify(__("Budget category has been deleted"));
        return back()->with($notification);
    }
}
