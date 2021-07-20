@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection


@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Jobs</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Jobs</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_job"><i class="fa fa-plus"></i> Add Job</a>
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
						<th>Job Title</th>
						<th>Department</th>
						<th>Start Date</th>
						<th>Expire Date</th>
						<th class="text-center">Job Type</th>
						<th class="text-center">Status</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($jobs as $job)
					<tr>
						<td><a target="_blank" href="{{route('job-view',$job)}}">{{$job->title}}</a></td>
						<td>{{$job->department->name}}</td>
						<td>{{date_format(date_create($job->start_date),"d M, Y")}}</td>
						<td>{{date_format(date_create($job->end_date),"d M, Y")}}</td>
						<td class="text-center">
							{{$job->type}}
						</td>
						<td class="text-center">
							{{$job->status}}
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a data-title="{{$job->title}}" data-department="{{$job->department->id}}" data-startDate="{{$job->start_date}}" data-expiryDate="{{$job->end_date}}" data-type="{{$job->type}}" href="javscript:void(0)" class="dropdown-item editbtn" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a data-id="{{$job->id}}" href="javascript:void(0)" class="dropdown-item deletebtn" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

<!-- Add Job Modal -->
<div id="add_job" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Job</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{route('jobs')}}">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Title</label>
								<input class="form-control" name="title" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Department</label>
								<select class="select" name="department">
									@if(!empty($departments))
										@foreach ($departments as $department)
											<option value="{{$department->id}}">{{$department->name}}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Location</label>
								<input class="form-control" name="location" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>No of Vacancies</label>
								<input class="form-control" name="vacancies" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Experience</label>
								<input class="form-control" name="experience" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Age</label>
								<input class="form-control" name="age" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Salary From</label>
								<input type="text" name="salary_from" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Salary To</label>
								<input type="text" name="salary_to" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Type</label>
								<select name="type" class="select">
									<option>Full Time</option>
									<option>Part Time</option>
									<option>Internship</option>
									<option>Temporary</option>
									<option>Remote</option>
									<option>Others</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="select">
									<option>Open</option>
									<option>Closed</option>
									<option>Cancelled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Start Date</label>
								<input type="text" name="start_date" class="form-control datetimepicker">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Expired Date</label>
								<input type="text" name="expire_date" class="form-control datetimepicker">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Description</label>
								<textarea id="my-editor" name="description" class="form-control">{!! old('description', '') !!}</textarea>
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
<!-- /Add Job Modal -->

<!-- Edit Job Modal -->
<div id="edit_job" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Job</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('jobs')}}" enctype="multipart/form-data">
					@csrf
					@method("PUT")
					<div class="row">
						<input type="hidden" name="id" id="edit_id">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Title</label>
								<input class="form-control edit_title" name="title" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Department</label>
								<select class="select edit_department" name="department">
									<option>-</option>
									@foreach ($departments as $department)
										<option value="{{$department->id}}">{{$department->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Location</label>
								<input class="form-control edit_location" name="location" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>No of Vacancies</label>
								<input class="form-control edit_vacancies" name="vacancies" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Experience</label>
								<input class="form-control edit_experience" name="experience" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Age</label>
								<input class="form-control edit_age" name="age" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Salary From</label>
								<input type="text" name="salary_from" class="form-control edit_salary_from">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Salary To</label>
								<input type="text" name="salary_to" class="form-control edit_salary_to">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Type</label>
								<select name="type" class="select edit_type">
									<option>Full Time</option>
									<option>Part Time</option>
									<option>Internship</option>
									<option>Temporary</option>
									<option>Remote</option>
									<option>Others</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="select edit_status">
									<option>Open</option>
									<option>Closed</option>
									<option>Cancelled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Start Date</label>
								<input type="text" name="start_date" class="form-control datetimepicker edit_start_date">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Expired Date</label>
								<input type="text" name="expire_date" class="form-control datetimepicker edit_expire_date">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control edit_description" name="description"></textarea>
							</div>
						</div>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Job Modal -->

<x-modals.delete :route="'jobs'" :title="'Job'" />
@endsection

@section('scripts')
	<!-- Datatable JS -->
	<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
	<script>
	var options = {
		filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
		filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
		filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
		filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
	};
	CKEDITOR.replace('my-editor', options);
	</script>
	<script>
	
	</script>
	<script>
		$(document).ready(function (){
			$('.datatable').on('click','.editbtn',function (){
				$('#edit_job').modal('show');
				var id = $(this).data('id');
				var title = $(this).data('title');
				var department = $(this).data('department');
				var startDate = $(this).data('startDate');
				var endDate = $(this).data('endDate');
				var experience = $(this).data('experience');
				var status = $(this).data('status');
				var type = $(this).data('type');
				var description = $(this).data('description');

				$('#edit_it').val(id);
				$('.edit_title').val(title);
				$('.edit_department').val(department);
				$('.edit_start_date').val(startDate);
				$('.edit_expire_date').val(expiryDate);
				$('.edit_status').val(status);
				$('.edit_type').val(type);
				$('.edit_description').val(description); 

			});
		})
	</script>
@endsection
