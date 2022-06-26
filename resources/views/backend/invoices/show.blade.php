@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Invoice</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Invoice</li>
		</ul>
	</div>
	
</div>
@endsection


@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6 m-b-20">
						<img src="{{!empty(app(App\Settings\InvoiceSettings::class)->logo) ? asset('storage/settings/'.app(App\Settings\InvoiceSettings::class)->logo):asset('assets/img/logo2.png')}}" class="inv-logo" alt="logo">
						 <ul class="list-unstyled">
							<li>{{app(App\Settings\CompanySettings::class)->company_name}}</li>
							<li>{{app(App\Settings\CompanySettings::class)->address}}</li>
							<li>{{app(App\Settings\CompanySettings::class)->email}}</li>
							<li>{{app(App\Settings\CompanySettings::class)->phone}}</li>
						</ul>
					</div>
					<div class="col-sm-6 m-b-20">
						<div class="invoice-details">
							<h3 class="text-uppercase">Invoice {{$invoice->inv_id}}</h3>
							<ul class="list-unstyled">
								<li>Date: <span>{{date_format(date_create($invoice->invoice_date),'d M, Y')}}</span></li>
								<li>Due date: <span>{{date_format(date_create($invoice->due_date),'d M, Y')}}</span></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
						<h5>Invoice to:</h5>
						 <ul class="list-unstyled">
							<li><h5><strong>{{$invoice->client->firstname.' '.$invoice->client->lastname}}</strong></h5></li>
							<li><span>{{$invoice->client->company}}</span></li>
							<li>{{$invoice->client_address}}</li>
							<li>{{$invoice->client->phone}}</li>
							<li><a href="javascript:void(0)">{{$invoice->client->email}}</a></li>
						</ul>
					</div>
					
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>ITEM</th>
								<th class="d-none d-sm-table-cell">DESCRIPTION</th>
								<th>UNIT COST</th>
								<th>QUANTITY</th>
								<th class="text-right">TOTAL</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($invoice->items as $item)
								
							<tr>
								<td>{{$item['id']}}</td>
								<td>{{$item['name']}}</td>
								<td class="d-none d-sm-table-cell">{{$item['description']}}</td>
								<td>{{app(App\Settings\ThemeSettings::class)->currency_symbol.' '.$item['unit_cost']}}</td>
								<td>{{$item['quantity']}}</td>
								<td class="text-right">{{app(App\Settings\ThemeSettings::class)->currency_symbol.' '.$item['amount']}}</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
				<div>
					<div class="row invoice-payment">
						<div class="col-sm-7">
						</div>
						<div class="col-sm-5">
							<div class="m-b-20">
								<div class="table-responsive no-border">
									<table class="table mb-0">
										<tbody>
											<tr>
												<th>Subtotal:</th>
												<td class="text-right">$7,000</td>
											</tr>
											<tr>
												<th>Tax: <span class="text-regular">({{$invoice->tax->percentage}}%)</span></th>
												<td class="text-right">{{app(App\Settings\ThemeSettings::class)->currency_symbol.' '.(($invoice->tax->percentage/100) * $invoice->total)}}</td>
											</tr>
											<tr>
												<th>Total:</th>
												<td class="text-right text-primary"><h5>{{app(App\Settings\ThemeSettings::class)->currency_symbol.' '.$invoice->total}}</h5></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="invoice-info">
						<h5>Other information</h5>
						<p class="text-muted">{{$invoice->note}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-repeater/jquery.repeater.min.js')}}"></script>
<script>
    $(document).ready(function(){
        'use strict';
		var index = 0;
		
		var tax = $('#inv_tax').val();
		
        $('table.repeater').repeater({

            show: function () {
				var id = $(`input[name="items[${index}][id]"]`);
				var name = $(`input[name="items[${index}][name]"]`);
				var unit_cost = $(`input[name="items[${index}][unit_cost]"]`);
				var quantity = $(`input[name="items[${index}][quantity]"]`);
				var amount = $(`input[name="items[${index}][amount]"]`);
				var item_amount = unit_cost.val() * quantity.val();
				amount.val(item_amount);
				
				index++;
				id.val(index)
				$(this).slideDown();
            },
			
            hide: function (deleteElement) {
				index--;
				$(this).slideUp(deleteElement);
            },
			
        });

    });
</script>
@endsection