@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Leaves</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Leaves</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
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
							<th>Leave Type</th>
							<th>From</th>
							<th>To</th>
							
							<th>Reason</th>
							<th class="text-center">Status</th>
							<th>Employee</th>
							<th class="text-right">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($leaves as $leave)
							<tr>
								<td>{{$leave->leaveType->type}}</td>
								<td>{{date_format(date_create($leave->from),"d M, Y")}}</td>
								<td>{{date_format(date_create($leave->to),"d M, Y")}}</td>
								<td>{{$leave->reason}}</td>
								<td class="text-center">
									<div class="action-label">
										<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
											@if ($leave->status =='Approved')
											<i class="fa fa-dot-circle-o text-success"></i> Approved
											@else
											<i class="fa fa-dot-circle-o text-danger"></i> Declined
											@endif
										</a>
									</div>
								</td>
								<td>
									<h2 class="table-avatar">
										<a href="javascript:void(0)" class="avatar avatar-xs">
											<img alt="avatar" src="@if(!empty($leave->employee->avatar)) {{asset('storage/employees/'.$leave->employee->avatar)}} @else assets/img/profiles/default.jpg @endif">
										</a>
										<a href="#">{{$leave->employee->firstname}} {{$leave->employee->lastname}}</a>
									</h2>
								</td>
								<td class="text-right">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											{{-- <a data-id="{{$leave->id}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a> --}}
											<a data-id="{{$leave->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
						@endforeach	
						<!-- delete Leave Modal -->
						<x-modals.delete :route="'leave.destroy'" :title="'Leave'" />
						<!-- /delete Leave Modal -->					
					</tbody>
				</table>
			</div>
		</div>
	</div>

<!-- Add Leave Modal -->
<div id="add_leave" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Leave</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('employee-leave')}}">
					@csrf

					<div class="form-group">
						<label>Employee</label>
						<select name="employee" class="select">
							@foreach ($employees as $employee)
								<option value="{{$employee->id}}">{{$employee->firstname}} {{$employee->lastname}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Leave Type <span class="text-danger">*</span></label>
						<select name="leave_type" class="select">
							@foreach ($leave_types as $leave_type)
								<option value="{{$leave_type->id}}">{{$leave_type->type}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>From <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input name="from" class="form-control datetimepicker" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>To <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input name="to" class="form-control datetimepicker" type="text">
						</div>
					</div>
					
					<div class="form-group">
						<label>Leave Reason <span class="text-danger">*</span></label>
						<textarea name="reason" rows="4" class="form-control"></textarea>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Leave Modal -->

<!-- Edit Leave Modal -->
<div id="edit_leave" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Leave</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>Leave Type <span class="text-danger">*</span></label>
						<select class="select">
							<option>Select Leave Type</option>
							<option>Casual Leave 12 Days</option>
						</select>
					</div>
					<div class="form-group">
						<label>From <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" value="01-01-2019" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>To <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" value="01-01-2019" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>Number of days <span class="text-danger">*</span></label>
						<input class="form-control" readonly type="text" value="2">
					</div>
					<div class="form-group">
						<label>Remaining Leaves <span class="text-danger">*</span></label>
						<input class="form-control" readonly value="12" type="text">
					</div>
					<div class="form-group">
						<label>Leave Reason <span class="text-danger">*</span></label>
						<textarea rows="4" class="form-control">Going to hospital</textarea>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Leave Modal -->
@endsection

@section('scripts')
<!-- Datatable JS -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
@endsection
