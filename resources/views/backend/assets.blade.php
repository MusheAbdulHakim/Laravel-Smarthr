@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Assets</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Assets</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>Asset Name</th>
						<th>Asset Id</th>
						<th>Purchase Date</th>
						<th>Warrenty</th>
						<th>Supplier</th>
						<th>Amount</th>
						<th class="text-center">Status</th>
						<th class="text-right"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($assets as $asset)
						<tr>
							<td>
								<strong>{{$asset->name}}</strong>
							</td>
							<td>{{$asset->uuid}}</td>
							<td>{{date_format(date_create($asset->purchase_date),'D M,Y')}}</td>
							<td>{{$asset->warranty}} Months</td>
							<td>{{$asset->supplier}}</td>
							<td>{{AppSettings::get('currency','$')}} {{$asset->value}}</td>
							<td class="text-center">
								<i class="fa fa-dot-circle-o @if($asset->status == 'Approved')text-success @elseif($asset->status == 'Pending') text-danger @elseif($asset->status == 'Returned') text-info @endif"></i> {{$asset->status}}
							</td>
							<td class="text-right">
								<div class="dropdown dropdown-action">
									<a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a data-id="{{$asset->id}}" data-name="{{$asset->name}}" 
											data-uuid="{{$asset->uuid}}" data-pdate="{{$asset->purchase_date}}"
											 data-pfrom="{{$asset->purchase_from}}" 
											 data-manufacturer="{{$asset->manufacturer}}"
											 data-model="{{$asset->model}}" data-sn="{{$asset->serial_number}}" data-supplier="{{$asset->supplier}}" data-condition="{{$asset->condition}}" data-warranty="{{$asset->warranty}}" data-value="{{$asset->value}}"
											 data-status="{{$asset->status}}" data-description="{{$asset->description}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<a data-id="{{$asset->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr>
					@endforeach					
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Add Asset Modal -->
<div id="add_asset" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Asset</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{route('assets')}}">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Asset Name</label>
								<input class="form-control" name="name" type="text">
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Purchase Date</label>
								<input class="form-control datetimepicker" name="purchase_date" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Purchase From</label>
								<input class="form-control" name="purchase_from" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Manufacturer</label>
								<input class="form-control" name="manufacturer" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Model</label>
								<input class="form-control" name="model" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Serial Number</label>
								<input class="form-control" name="serial_number" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Supplier</label>
								<input class="form-control" name="supplier" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Condition</label>
								<input class="form-control" name="condition" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Warranty</label>
								<input class="form-control" name="warranty" type="text" placeholder="In Months">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Value</label>
								<input name="value" placeholder="1800" class="form-control" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="select">
									<option>Approved</option>
									<option>Pending</option>
									<option>Returned</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Asset Modal -->

<!-- Edit Asset Modal -->
<div id="edit_asset" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Asset</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{route('assets')}}">
					@csrf
					@method("PUT")
					<div class="row">
						<input type="hidden" name="id" id="edit_id">
						<div class="col-md-6">
							<div class="form-group">
								<label>Asset Name</label>
								<input class="form-control edit_name" name="name" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Asset Id</label>
								<input name="uuid" class="form-control edit_uuid" type="text" value="#AST-0001" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Purchase Date</label>
								<input class="form-control datetimepicker edit_date" name="purchase_date" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Purchase From</label>
								<input class="form-control edit_from" name="purchase_from" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Manufacturer</label>
								<input class="form-control edit_manufacturer" name="manufacturer" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Model</label>
								<input class="form-control edit_model" name="model" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Serial Number</label>
								<input class="form-control edit_serial" name="serial_number" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Supplier</label>
								<input class="form-control edit_supplier" name="supplier" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Condition</label>
								<input class="form-control edit_condition" name="condition" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Warranty</label>
								<input class="form-control edit_warranty" name="warranty" type="text" placeholder="In Months">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Value</label>
								<input name="value" placeholder="1800" class="form-control edit_value" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="select" id="status_select" selected="selected">
									<option>Pending</option>
									<option>Approved</option>
									<option>Returned</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control edit_description"></textarea>
							</div>
						</div>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Edit Asset Modal -->
<x-modals.delete :route="'assets'" :title="'Asset'"/>
@endsection

@section('scripts')
	<!-- Datatable JS -->
	<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
	<script>
		$(document).ready(function(){
			$('.table').on('click','.editbtn',function(){
				$('#edit_asset').modal('show');
				var id = $(this).data('id');
				var uuid = $(this).data('uuid');
				var name = $(this).data('name');
				var purchase_date = $(this).data('pdate');
				var purchase_from = $(this).data('pfrom');
				var manufacturer = $(this).data('manufacturer');
				var serial_number = $(this).data('sn');
				var model = $(this).data('model');
				var supplier = $(this).data('supplier');
				var condition = $(this).data('condition');
				var warranty = $(this).data('warranty');
				var value = $(this).data('value');
				var status = $(this).data('status');
				var description = $(this).data('description');
				$('#edit_id').val(id);
				$('.edit_name').val(name);
				$('.edit_uuid').val(uuid);
				$('.edit_date').val(purchase_date);
				$('.edit_from').val(purchase_from);
				$('.edit_manufacturer').val(manufacturer);
				$('.edit_model').val(model);
				$('.edit_serial').val(serial_number);
				$('.edit_supplier').val(supplier);
				$('.edit_condition').val(condition);
				$('.edit_warranty').val(warranty);
				$('.edit_value').val(value);
				$("#status_select").val(status).change();
				$('.edit_description').val(description);
			});
		});
	</script>
@endsection