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
		<h3 class="page-title">Edit Invoice</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Edit Invoice</li>
		</ul>
	</div>
	
</div>
@endsection


@section('content')
<div class="row">
	<div class="col-md-12">
		<form action="{{route('invoices.update',$invoice->id)}}" method="post" enctype="multipart/form-data">
			@csrf
			@method("PUT")
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Client <span class="text-danger">*</span></label>
						<select class="select2" name="client">
							<option value="null">Select Client</option>
							@foreach (\app\Models\Client::get() as $client)
                                <option {{($invoice->client_id == $client->id) ?'selected':'' }} value="{{$client->id}}">{{$client->firstname.' '.$client->lastname}}</option>
                            @endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Project <span class="text-danger">*</span></label>
						<select class="select2" name="project" title="select project">
							<option value="null">Select Project</option>
							@foreach (\app\Models\Project::get() as $project)
								<option {{($invoice->project_id == $project->id) ?'selected':'' }} value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" type="email" name="email" value="{{$invoice->email}}">
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Tax</label>
						<select name="tax" class="select2" title="select tax" id="inv_tax">
							<option value="null">Select Tax</option>
							@foreach (\app\Models\Tax::get() as $tax)
							<option {{($invoice->tax_id == $tax->id) ?'selected':'' }} value="{{$tax->id}}">{{$tax->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Client Address</label>
						<textarea class="form-control" rows="3" name="client_address">{{$invoice->client_address}}</textarea>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Billing Address</label>
						<textarea class="form-control" rows="3" name="billing_address">{{$invoice->billing_address}}</textarea>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Invoice date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" type="text" name="invoice_date" value="{{$invoice->invoice_date}}">
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Due Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" type="text" name="due_date" value="{{$invoice->due_date}}">
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
									<th>#</th>
									<th class="col-sm-2">Item</th>
									<th class="col-md-6">Description</th>
									<th style="width:100px;">Unit Cost</th>
									<th style="width:80px;">Qty</th>
									<th>Amount</th>
									<th><button type="button" class="btn btn-sm btn-success font-18 mr-1" title="Add" data-repeater-create>
										<i class="fa fa-plus"></i>
									</button> </th>
								</tr>
							</thead>
							<tbody data-repeater-list="items">
								@if (!empty($invoice->items))
									
									@foreach ($invoice->items as $item)
									<tr data-repeater-item>
										<td>
											<input type="text" name="id" class="form-control" style="min-width:50px" readonly value="{{$item['id']}}">
										</td>
										<td>
											<input class="form-control" name="name" value="{{$item['name']}}" type="text" style="min-width:150px">
										</td>
										<td>
											<input class="form-control" name="description" value="{{$item['description']}}" type="text" style="min-width:150px">
										</td>
										<td>
											<input class="form-control"  name="unit_cost" value="{{$item['unit_cost']}}" style="width:100px" type="text">
										</td>
										<td>
											<input class="form-control" name="quantity" value="{{$item['quantity']}}" style="width:80px" type="text">
										</td>
										<td>
											<input class="form-control" name="amount" value="{{$item['amount']}}" readonly style="width:120px" type="text">
										</td>
										<td>
											<button type="button" class="btn btn-sm btn-danger font-18 ml-2" title="Delete" data-repeater-delete>
												<i class="fa fa-trash"></i>
											</button>
											
										</td>
									</tr>
									@endforeach
								@else
								<tr data-repeater-item>
									<td>
										<input type="text" name="id" class="form-control" style="min-width:50px" readonly value="1">
									</td>
									<td>
										<input class="form-control" name="name" type="text" style="min-width:150px">
									</td>
									<td>
										<input class="form-control" name="description" type="text" style="min-width:150px">
									</td>
									<td>
										<input class="form-control"  name="unit_cost"  style="width:100px" type="text">
									</td>
									<td>
										<input class="form-control" name="quantity" style="width:80px" type="text">
									</td>
									<td>
										<input class="form-control" name="amount" readonly style="width:120px" type="text">
									</td>
									<td>
										<button type="button" class="btn btn-sm btn-danger font-18 ml-2" title="Delete" data-repeater-delete>
											<i class="fa fa-trash"></i>
										</button>
										
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
									<td class="text-right">Total</td>
									<td style="text-align: right; width: 230px">{{count($invoice->items)}}</td>
								</tr>
								<tr>
									<td colspan="5" style="text-align: right">Tax</td>
									<td style="text-align: right;width: 230px">
										<input class="form-control text-right" value="{{(($invoice->tax->percentage/100) * $invoice->total)}}" readonly type="text">
									</td>
								</tr>
								
								<tr>
									<td colspan="5" style="text-align: right; font-weight: bold">
										Grand Total
									</td>
									<td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px;color:black">
										{{app(App\Settings\ThemeSettings::class)->currency_symbol.' '.($invoice->total)}}
									</td>
								</tr>
							</tbody>
						</table>                               
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Discount </label>
						<input class="form-control text-right" type="text" name="discount" value="{{$invoice->discount}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Status</label>
						<select name="status" id="status" class="select2 form-control">
							<option value="paid">Paid</option>
							<option value="pending">Pending</option>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Other Information</label>
						<textarea class="form-control" name="note">{{$invoice->note}}</textarea>
					</div>
				</div>	
			</div>
			<div class="submit-section">
				<button class="btn btn-primary submit-btn">Save</button>
			</div>
		</form>
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
		var index = "{{count($invoice->items)}}";
		var status = $('#status').val("{{$invoice->status}}").trigger('change');
		
        $('table.repeater').repeater({
            show: function () {
				var id = $(`input[name="items[${index}][id]"]`);
				var name = $(`input[name="items[${index}][name]"]`);
				var unit_cost = $(`input[name="items[${index}][unit_cost]"]`);
				var quantity = $(`input[name="items[${index}][quantity]"]`);
				var amount = $(`input[name="items[${index}][amount]"]`);
				$(this).keyup(function(){
					var item_amount = unit_cost.val() * quantity.val();
					amount.val(item_amount);
				});				
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