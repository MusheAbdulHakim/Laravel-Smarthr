<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Sales\Models\Tax;
use Yajra\DataTables\DataTables;
use Modules\Sales\Models\Estimate;
use Illuminate\Support\Facades\App;
use Modules\Project\Models\Project;
use App\Http\Controllers\Controller;
use App\DataTables\EstimateDataTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Modules\Sales\Models\EstimateItem;

class EstimatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Estimates');
        if($request->ajax()){
            $estimates = Estimate::get();
            return DataTables::of($estimates)
                ->addIndexColumn()
                ->addColumn('est_no', function($row){
                    $param = ['estimate' => Crypt::encrypt($row->id)];
                    return '<a href="'.route('estimates.show',$param).'">'.$row->est_id.'</a>';
                })
                ->addColumn('start_date', function($row){
                    return format_date($row->startDate);
                })
                ->addColumn('due_date', function($row){
                    return format_date($row->expiryDate);
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at);
                })
                ->addColumn('client', function($row){
                    if(!empty($row->client_id)){
                        return $row->client->fullname;
                    }
                })
                ->addColumn('grand_total', function($row){
                    if(!empty($row->grand_total)){
                        return LocaleSettings('currency_symbol').' '.$row->grand_total;
                    }
                })
                ->addColumn('status', function($row){
                    $color = 'success';
                    switch( $row->status ){
                        case 'Accepted':
                            $color = 'success';
                        case 'Declined':
                            $color = 'danger';
                        case 'Send':
                            $color = 'info';
                        case 'Expired':
                            $color = 'warning';
                        default:
                            $color = 'success';
                    }
                    return '<span class="badge bg-inverse-'.$color.'">'.ucwords($row->status).'</span>';
                })
                ->addColumn('action', function($row){
                    $id = $row->id;
                    return view('sales::estimates.actions',compact('id'));
                })->rawColumns(['est_no','action','status'])
                ->make();
        }
        return view('sales::estimates.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = __('Create Estimate');
        $clients = User::where('type',UserType::CLIENT)->get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('sales::estimates.create',compact(
            'pageTitle','clients','projects','taxes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required',
            'billing_address' => 'required',
            'startDate' => 'required|date|before_or_equal:expiryDate',
            'expiryDate' => 'required|date|after_or_equal:startDate',
        ]);
        $estimate = Estimate::create([
            'est_id' => "EST-" . pad_zeros(Estimate::count() + 1),
            'client_id' => $request->client,
            'project_id' => $request->project,
            'taxe_id' => $request->tax,
            'client_address' => $request->client_address,
            'billing_address' => $request->billing_address,
            'startDate' => $request->startDate,
            'expiryDate' => $request->expiryDate,
            'tax_amount' => $request->taxes_sum,
            'discount' => $request->discount,
            'grand_total' => $request->grand_total,
            'subtotal' => $request->subtotal,
            'note' => $request->note,
            'status' => $request->status
        ]);
        $items = $request->items;
        if(!empty($items) && count($items) > 0){
            foreach($items as $item){
                EstimateItem::create([
                    'estimate_id' => $estimate->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'unit_cost' => $item['cost'],
                    'quantity' => $item['qty'],
                    'total' => $item['total']
                ]);
            }
        }
        $notification  = notify(__('Estimate has been created'));
        return redirect()->route('estimates.index')->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show(string $estimate)
    {
        $estimate = Estimate::findOrFail(Crypt::decrypt($estimate));
        $pageTitle = $estimate->est_id;
        return view('sales::estimates.show',compact(
            'estimate','pageTitle'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageTitle = __('Edit Estimate');
        $estimate = Estimate::findOrFail(Crypt::decrypt($id));
        $clients = User::where('type',UserType::CLIENT)->get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('sales::estimates.edit',compact(
            'pageTitle','clients','projects','taxes','estimate'
        ));
    }

    public function destroyItem(EstimateItem $item){
        $item->delete();
        $notification = notify(__("Estimate item has been deleted"));
        return back()->with($notification);
    }

    public function downloadPdf(Request $request, Estimate $estimate)
    {
        $html =  ($request->html);
        if(!empty($html)){
            $pdf = App::make('snappy.pdf.wrapper');
            return $pdf->loadHTML($html)
                    ->setOption('viewport-size', '1366x1024')
                    ->setOption('enable-javascript', true)
                    ->setOption('javascript-delay', 4000)
                    ->setPaper('letter')
                    ->download("$estimate->est_id.pdf");
        }
        return response()->json('No HTML data was sent to the server');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estimate $estimate)
    {
        $request->validate([
            'client' => 'required',
            'billing_address' => 'required',
            'startDate' => 'required|date|before_or_equal:expiryDate',
            'expiryDate' => 'required|date|after_or_equal:startDate',
        ]);
        $estimate->update([
            'client_id' => $request->client,
            'project_id' => $request->project,
            'taxe_id' => $request->tax,
            'client_address' => $request->client_address,
            'billing_address' => $request->billing_address,
            'startDate' => $request->startDate,
            'expiryDate' => $request->expiryDate,
            'tax_amount' => $request->taxes_sum,
            'discount' => $request->discount,
            'grand_total' => $request->grand_total,
            'subtotal' => $request->subtotal,
            'note' => $request->note,
            'status' => $request->status
        ]);
        $items = $request->items;
        EstimateItem::whereNotIn('id',collect($items)->pluck('id')->all())->delete();
        if(!empty($items) && count($items) > 0){
            foreach($items as $item){
                EstimateItem::updateOrCreate([
                    'id' => $item['id'],
                    'estimate_id' => $estimate->id,
                ],[
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'unit_cost' => $item['cost'],
                    'quantity' => $item['qty'],
                    'total' => $item['total']
                ]);
            }
        }
        $notification  = notify(__('Estimate has been updated'));
        return redirect()->route('estimates.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimate $estimate)
    {
        $estimate->delete();
        $notification = notify(__("Estimate has been deleted"));
        return back()->with($notification);
    }
}
