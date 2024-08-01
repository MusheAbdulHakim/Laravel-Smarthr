@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Edit Invoice') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">{!! config('sales.name') !!}</a>
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div x-data="{
                        subtotalVal: {{ $invoice->subtotal ?? 0.00 }},
                        discount: {{ $invoice->discount ?? 0.00 }}, 
                        taxPercentage: {{ $invoice->tax->percentage ?? 0.00 }},
                        setTax: function(e){
                            if(e){
                                this.taxPercentage = parseFloat(this.subtotalVal * (e/100)).toFixed(2)
                            }
                        },
                        calculateTotal(total){
                            if(!total){
                                var subtotal = 0.00;
                                $('table.repeater > tbody > tr').each(function(i){
                                    const p = $(this).find('input.totalInput').val()
                                    subtotal += parseFloat(p) 
                                });
                                this.subtotalVal = parseFloat(subtotal)
                            }else
                            {
                                this.subtotalVal -= total
                            }
                        }
                    }" x-init="console.log('hello')">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" required>{{ __('Client') }} </label>
                                    <select class="form-control select" name="client">
                                        <option value="">{{ __('Please Select') }}</option>
                                        @foreach ($clients as $client)
                                            <option {{ $invoice->client_id == $client->id ? 'selected': '' }} value="{{ $client->id }}">{{ $client->fullname }}</option>
                                        @endforeach                     
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" required>{{ __('Project') }}</label>
                                    <select class="form-control select" name="project">
                                        <option value="">{{ __('Select Project') }}</option>
                                        @foreach ($projects as $project)
                                            <option {{ $invoice->project_id == $project->id ? 'selected': '' }} value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                      
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">{{ __('Tax') }}</label>
                                    <select class="form-control" @change="setTax($el.selectedOptions[0].getAttribute('data-percent'))" name="tax">
                                        <option value="" readonly>{{ __('No Tax') }}</option>
                                        @foreach ($taxes as $tax)
                                            <option {{ $invoice->taxe_id === $tax->id ? 'selected': '' }} data-percent="{{ $tax->percentage }}" value="{{ $tax->id }}">{{ $tax->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <x-form.label class="col-form-label" required>{{ __('Status') }} </x-form.label>
                                    <select class="form-control" name="status">
                                        <option value="">{{ __('Select Status') }}</option>           
                                        <option {{ $invoice->status == '1' ? 'selected': '' }} value="1">{{ __('Sent') }}</option>           
                                        <option {{ $invoice->status == '2' ? 'selected': '' }} value="2">{{ __('Paid') }}</option>           
                                        <option {{ $invoice->status == '3' ? 'selected': '' }} value="3">{{ __('Partially Paid') }}</option>           
                                        <option {{ $invoice->status == '4' ? 'selected': '' }} value="4">{{ __('Declined') }}</option>           
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">{{ __('Client Address') }}</label>
                                    <textarea class="form-control" name="client_address" rows="3">{{ old('client_address', $invoice->client_address) }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <label>{{ __('Billing Address') }}</label>
                                    <textarea class="form-control" name="billing_address" rows="3">{{ old('billing_address', $invoice->billing_address) }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <label>{{ __('Invoice Date') }} </label>
                                    <div class="cal-icon">
                                        <input class="form-control datepicker" type="text" name="startDate" value="{{ old('startDate', $invoice->startDate) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="input-block mb-3">
                                    <label>{{ __('Due Date') }} </label>
                                    <div class="cal-icon">
                                        <input class="form-control datepicker" type="text" name="expiryDate" value="{{ old('expiryDate', $invoice->expiryDate) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-white repeater">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-2">{{ __('Item') }}</th>
                                                <th class="col-md-6">{{ __('Description') }}</th>
                                                <th>{{ __('Unit Cost') }}</th>
                                                <th>{{ __('Qty') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                                <th>
                                                    <button type="button" class="btn btn-sm btn-success font-18 mr-1" title="Add" data-repeater-create>
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbodyone" data-repeater-list="items" @change="calculateTotal()">
                                            @if (!empty($invoice->items) && $invoice->items->count() > 0)
                                                @foreach ($invoice->items as $item)
                                                <tr data-repeater-item x-data="{quantity: {{ $item->quantity ?? 0 }}, cost: {{ $item->unit_cost ?? 0 }}}">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <td>
                                                        <input class="form-control" name="name" type="text" value="{{ $item->name }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="description" type="text" value="{{ $item->description }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" x-model="cost" name="cost" type="text">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" x-model="quantity" name="qty" type="text">
                                                    </td>
                                                    <td>
                                                        <input class="form-control totalInput"  :value="cost*quantity" name="total" readonly type="text">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="text-danger font-18 ms-2" data-bs-toggle="tooltip" title="Delete" data-itemId="{{ $item->id }}" data-repeater-delete="hide" @click="calculateTotal((cost*quantity))">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr data-repeater-item x-data="{quantity: 1, cost: 0}">
                                                <td>
                                                    <input class="form-control" name="name" type="text">
                                                </td>
                                                <td>
                                                    <input class="form-control" name="description" type="text">
                                                </td>
                                                <td>
                                                    <input class="form-control" x-model="cost" name="cost" type="text">
                                                </td>
                                                <td>
                                                    <input class="form-control" x-model="quantity" name="qty" type="text">
                                                </td>
                                                <td>
                                                    <input class="form-control totalInput"  :value="parseFloat(cost)*parseFloat(quantity)" name="total" readonly type="text">
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-danger font-18 ms-2" data-bs-toggle="tooltip" title="Delete" data-repeater-delete="hide" @click="calculateTotal((cost*quantity))">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-white">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-end">{{ __('Sub Total') }}</td>
                                                <td class="text-end pe-4"><input type="text" class="form-control text-end" x-model="subtotalVal" name="subtotal" readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-end taxTd">{{ __('Tax') }} (<span x-text="taxPercentage"></span>%)</td>
                                                <td class="text-end pe-4">
                                                    <input class="form-control text-end" x-model="taxPercentage" name="taxes_sum" id="taxes_sum" readonly type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-end">
                                                    {{ __('Discount') }} %
                                                </td>
                                                <td class="text-end pe-4">
                                                    <input class="form-control text-end" type="text" x-model="discount" name="discount">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-end pe-4">
                                                    <b>{{ __('Grand Total') }} {{ LocaleSettings('currency_symbol') }}</b>
                                                </td>
                                                <td class="text-end tdata-width pe-4">
                                                    <input type="text" :value="parseFloat(subtotalVal)+parseFloat(taxPercentage)-parseFloat(discount)" class="form-control text-end" name="grand_total" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                               
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-block mb-3">
                                            <label>{{ __('Other Information') }}</label>
                                            <textarea class="form-control" rows="4" name="note">{{ old('note', $invoice->note) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->
    <script type="module" defer>
        $(document).ready(function(){
            $('table.repeater').repeater({
                initEmpty: false,
                isFirstItemUndeletable: true,
                defaultValues: {
                    'cost': 1,
                    'qty': 1,
                    'total': 1,
                },
                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                    $('table.repeater > tbody').trigger('change')
                },
            });
            $('.datepicker').each(function(){
                $(this).datetimepicker({
                    format: 'YYYY-MM-DD',
                    icons: {
                        up: "fa fa-angle-up",
                        down: "fa fa-angle-down",
                        next: 'fa fa-angle-right',
                        previous: 'fa fa-angle-left'
                    }
                });
            })
            
        });
    </script>
    <!-- /Page Js -->
@endpush


  