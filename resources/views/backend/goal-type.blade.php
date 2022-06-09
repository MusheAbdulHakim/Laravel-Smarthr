@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection


@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Goal Type</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Goal Type</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_type"><i class="fa fa-plus"></i> Add New</a>
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
						<th>Type </th>
						<th>Description </th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($goal_types as $type)
						<tr>
							<td>{{$type->type}}</td>
							<td>{{$type->description}}</td>
							
							<td class="text-right">
								<div class="dropdown dropdown-action">
									<a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a data-id="{{$type->id}}" data-type="{{$type->type}}" data-description="{{$type->description}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<a data-id="{{$type->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

<!-- Add Goal Modal -->
<div id="add_type" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Goal Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{route('goal-type')}}">
					@csrf
					<div class="form-group">
						<label>Goal Type <span class="text-danger">*</span></label>
						<input class="form-control" name="type" type="text">
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea name="description" class="form-control" rows="4"></textarea>
					</div>
					
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Goal Modal -->

<!-- Edit Goal Modal -->
<div id="edit_type" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Goal Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{route('goal-type')}}">
					@csrf
					@method("PUT")
					<input id="edit_id" type="hidden" name="id">
					<div class="form-group">
						<label>Goal Type <span class="text-danger">*</span></label>
						<input class="form-control edit_type" name="type" type="text" value="Invoice Goal">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control edit_description" name="description" rows="4"></textarea>
					</div>
					
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Goal Modal -->

<x-modals.delete :route="'goal-type'" :title="'Goal Type'" />
@endsection	

@section('scripts')
	<!-- Datatable JS -->
	<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
	<script>
		$(document).ready(function (){
			$('.table').on('click','.editbtn',function (){
				$('#edit_type').modal('show');
				var id = $(this).data('id');
				var type = $(this).data('type');
				var description = $(this).data('description');
				$('#edit_id').val(id);
				$('.edit_type').val(type);
				$('.edit_description').val(description);
			});
		});
	</script>
@endsection


