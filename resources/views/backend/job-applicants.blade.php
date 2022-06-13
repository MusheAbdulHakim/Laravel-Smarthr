@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection


@section('page-header')
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Job Applicants</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item active">Job Applicants</li>
			</ul>
		</div>
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
						<th>Position</th>
						<th>Name</th>
						<th>Email</th>
						<th>Apply Date</th>
						<th class="text-center">Status</th>
						<th>Resume</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($applicants as $applicant)	
						<tr>
							<td>{{$applicant->Job->title}}</td>
							<td>{{$applicant->name}}</td>
							<td>{{$applicant->email}}</td>
							<td>{{$applicant->created_at->diffForHumans()}}</td>
							<td class="text-center">
								<div class="dropdown action-label">
									<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
										<i class="fa fa-dot-circle-o text-info"></i> New
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> New</a>
										<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Hired</a>
										<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Rejected</a>
										<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Interviewed</a>
									</div>
								</div>
							</td>
							<td>
								<form action="{{route('download-cv')}}" method="post">
									@csrf
									<input type="hidden" name="cv" value="{{$applicant->cv}}">
									<button class="btn btn-sm btn-primary" type="submit">
										<i class="fa fa-download"></i>
										 Download
									</button>	
									
								</form>
							</td>
							<td class="text-right">
								<div class="dropdown dropdown-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#"><i class="fa fa-clock-o m-r-5"></i> Schedule Interview</a>
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
@endsection


@section('scripts')
	<!-- Datatable JS -->
	<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
@endsection
