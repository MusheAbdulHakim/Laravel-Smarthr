<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Sales\Models\Tax;
use Yajra\DataTables\DataTables;
use Modules\Sales\Models\Invoice;
use Modules\Project\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Modules\Sales\Models\InvoiceItem;
use Illuminate\Support\Facades\Notification;
use Modules\Sales\Notifications\SendInvoiceNotification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = __('Invoices');
        if($request->ajax()){
            $invoices = Invoice::get();
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('inv_id', function($row){
                    $param = ['invoice' => Crypt::encrypt($row->id)];
                    return '<a href="'.route('invoices.show',$param).'">'.$row->inv_id.'</a>';
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
                    $name = __('Sent');
                    $status = $row->status;
                    if($status == 1){
                        $color = 'info';
                        $name = __('Sent');
                    }
                    if($status == 2){
                        $color = 'success';
                        $name = __('Paid');
                    }
                    if($status == 3){
                        $color = 'warning';
                        $name = __('Partially Paid');
                    }
                    if($status == 4){
                        $color = 'danger';
                        $name = __('Declined');
                    }
                    return '<span class="badge bg-inverse-'.$color.'">'.ucwords($name).'</span>';
                })
                ->addColumn('action', function($row){
                    $id = $row->id;
                    return view('sales::invoices.actions',compact('id'));
                })->rawColumns(['inv_id','action','status'])
                ->make();
        }
        return view('sales::invoices.index',compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = __('Create Invoice');
        $clients = User::where('type',UserType::CLIENT)->get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('sales::invoices.create',compact(
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
        $invoiceSettings = app(\App\Settings\InvoiceSettings::class);
        $invoice = Invoice::create([
            'inv_id' => ($invoiceSettings->prefix ? $invoiceSettings->prefix: '#INV-'). pad_zeros(Invoice::count() + 1),
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
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'unit_cost' => $item['cost'],
                    'quantity' => $item['qty'],
                    'total' => $item['total'],
                ]);
            }
        }   
        if(!empty($request->has('send'))){
            Notification::send( $invoice->client, new SendInvoiceNotification($invoice));
        }
        $notification = notify(__('Invoice has been created'));
        return redirect()->route('invoices.index')->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show(string $invoice)
    {
        $invoice = Invoice::findOrFail(Crypt::decrypt($invoice));
        $pageTitle = $invoice->inv_id ?? __('Preview Invoice');
        return view('sales::invoices.show',compact(
            'pageTitle','invoice'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = __('Edit Invoice');
        $invoice = Invoice::findOrFail(Crypt::decrypt($id));
        $clients = User::where('type',UserType::CLIENT)->get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('sales::invoices.edit',compact(
            'pageTitle','clients','projects','taxes','invoice'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client' => 'required',
            'billing_address' => 'required',
            'startDate' => 'required|date|before_or_equal:expiryDate',
            'expiryDate' => 'required|date|after_or_equal:startDate',
        ]);
        $invoice->update([
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
        InvoiceItem::whereNotIn('id',collect($items)->pluck('id')->all())->delete();
        if(!empty($items) && count($items) > 0){
            foreach($items as $item){
                InvoiceItem::updateOrCreate([
                    'id' => $item['id'],
                    'invoice_id' => $invoice->id
                ],[
                    'invoice_id' => $invoice->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'unit_cost' => $item['cost'],
                    'quantity' => $item['qty'],
                    'total' => $item['total'],
                ]);
            }
        }  
        $notification = notify(__('Invoice has been updated'));
        return redirect()->route('invoices.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        $notification = notify(__('Invoice has been deleted'));
        return back()->with($notification);
    }
}
