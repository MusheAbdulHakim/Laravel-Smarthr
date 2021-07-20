@extends('layouts.backend')

@section('styles')
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Leave Type</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Leave Type</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leavetype"><i class="fa fa-plus"></i> Add Leave Type</a>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable mb-0">
				<thead>
					<tr>
						<th>Leave Type</th>
						<th>Leave Days</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($leave_types->count()))
						@foreach($leave_types as $leave_type)
						<tr>
							<td>{{$leave_type->type}}</td>
							<td>{{$leave_type->days}} {{ Str::plural('day',$leave_type->days) }}</td>
						   
							<td class="text-right">
								<div class="dropdown dropdown-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a data-id="{{$leave_type->id}}" data-type="{{$leave_type->type}}" data-days="{{$leave_type->days}}" class="dropdown-item editbtn" href="#" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<a data-id="{{$leave_type->id}}" class="dropdown-item deletebtn" href="#" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
						<x-modals.delete :route="'leave-type.destroy'" :title="'Leave Type'" />
					@endif										
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Leavetype Modal -->
<div id="add_leavetype" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Leave Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('leave-type')}}" method="POST">
					@csrf
					<div class="form-group">
						<label>Leave Type <span class="text-danger">*</span></label>
						<input class="form-control" name="type" type="text">
					</div>
					<div class="form-group">
						<label>Number of days <span class="text-danger">*</span></label>
						<input class="form-control" name="days" type="text">
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Leavetype Modal -->

<!-- Edit Leavetype Modal -->
<div id="edit_leavetype" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Leave Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('leave-type')}}">
					@csrf
					@method('PUT')
					<input id="edit_id" type="hidden" name="id">
					<div class="form-group">
						<label>Leave Type <span class="text-danger">*</span></label>
						<input class="form-control edit_type" name="type" type="text" >
					</div>
					<div class="form-group">
						<label>Number of days <span class="text-danger">*</span></label>
						<input class="form-control edit_days" name="days" type="text" >
					</div>
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Leavetype Modal -->
@endsection

@section('scripts')
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
	$(document).ready(function (){
		
		$('.editbtn').on('click',function (){
			$('#edit_leavetype').modal('show');
			var id = $(this).data('id');
			var type = $(this).data('type');
			var days = $(this).data('days');
			
			$('#edit_id').val(id);
			$('.edit_type').val(type);
			$('.edit_days').val(days);

		});
	});
</script>
@endsection

