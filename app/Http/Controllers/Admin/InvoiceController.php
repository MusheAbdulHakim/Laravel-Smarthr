<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\InvoiceSettings;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'invoices';
        $invoices = Invoice::get();
        return view('backend.invoices.index',compact(
            'title','invoices'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create invoice';
        return view('backend.invoices.create',compact(
            'title'
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
            'client' => 'required',
            'project' => 'required',
            'email' => 'required',
            'tax' => 'required',
            'client_address' => 'required',
            'billing_address' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'items' => 'required',
            'note' => 'nullable',
        ]);
        $settings = new InvoiceSettings();
        $prefix = $settings->prefix;
        $amount = 0;
        foreach($request->items as $item){
            $amount += $item['amount'];
        }
        $inv_id = IdGenerator::generate(['table' => 'invoices', 'length' =>9,'field'=>'inv_id', 'prefix' => $prefix]);
        Invoice::create([
            'inv_id' => $inv_id,
            'client_id' => $request->client,
            'project_id' => $request->project,
            'tax_id' => $request->tax,
            'email' => $request->email,
            'client_address' => $request->client_address,
            'billing_address' => $request->billing_address,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'items' => $request->items,
            'discount' => $request->discount,
            'total' => $amount,
            'note' =>$request->note,
            'status' => $request->status,
        ]);
        $notification = notify('invoice has been created');
        return redirect()->route('invoices.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $title = 'view invoice';
        return view('backend.invoices.show',compact(
            'invoice','title'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $title = 'edit invoice';
        return view('backend.invoices.edit',compact(
            'title','invoice'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->validate($request,[
            'client' => 'required',
            'project' => 'required',
            'email' => 'required',
            'tax' => 'required',
            'client_address' => 'required',
            'billing_address' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'items' => 'required',
            'note' => 'nullable',
        ]);
        $settings = new InvoiceSettings();
        $prefix = $settings->prefix;
        $amount = 0;
        foreach($request->items as $item){
            $amount += $item['amount'];
        }
        $invoice->update([
            'client_id' => $request->client,
            'project_id' => $request->project,
            'tax_id' => $request->tax,
            'email' => $request->email,
            'client_address' => $request->client_address,
            'billing_address' => $request->billing_address,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'items' => $request->items,
            'discount' => $request->discount,
            'total' => $amount,
            'note' =>$request->note,
            'status' => $request->status,
        ]);
        $notification = notify('invoice has been updated');
        return redirect()->route('invoices.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Invoice::findOrFail($request->id)->delete();
        $notification = notify('Invoice has been deleted successfully');
        return back()->with($notification);
    }
}
