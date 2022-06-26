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
		<h3 class="page-title">Create Invoice</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Create Invoice</li>
		</ul>
	</div>
	
</div>
@endsection


@section('content')
<div class="row">
	<div class="col-sm-12">
		<form action="{{route('invoices.store')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Client <span class="text-danger">*</span></label>
						<select class="select2" name="client">
							<option value="null">Select Client</option>
							@foreach (\app\Models\Client::get() as $client)
                                <option value="{{$client->id}}">{{$client->firstname.' '.$client->lastname}}</option>
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
								<option value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" type="email" name="email">
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Tax</label>
						<select name="tax" class="select2" title="select tax" id="inv_tax">
							<option value="null">Select Tax</option>
							@foreach (\app\Models\Tax::get() as $tax)
							<option value="{{$tax->id}}">{{$tax->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Client Address</label>
						<textarea class="form-control" rows="3" name="client_address"></textarea>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Billing Address</label>
						<textarea class="form-control" rows="3" name="billing_address"></textarea>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Invoice date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" type="text" name="invoice_date">
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Due Date <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" type="text" name="due_date">
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
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Discount </label>
						<input class="form-control text-right" type="text" name="discount" value="0">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Status</label>
						<select name="status" class="select2 form-control">
							<option value="paid">Paid</option>
							<option value="pending">Pending</option>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Other Information</label>
						<textarea class="form-control" name="note"></textarea>
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