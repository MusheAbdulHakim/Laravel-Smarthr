@extends('layouts.backend')


@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection


@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Users</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Users</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Created Date</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($users as $user)
					<tr>
						<td>
							<h2 class="table-avatar">
								<a href="profile.html" class="avatar"><img src="assets/img/profiles/avatar-21.jpg" alt=""></a>
								{{$user->name}}
							</h2>
						</td>
						<td>{{$user->username}}</td>
						<td>{{$user->email}}</td>
						<td>{{date_format(date_create($user->created_at),'d M, Y')}}</td>
						
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a data-id="{{$user->id}}" class="dropdown-item deletebtn" href="#" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
<!-- Add User Modal -->
<div id="add_user" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{route('users')}}">
					@csrf
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Full Name <span class="text-danger">*</span></label>
								<input class="form-control" name="name" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Avatar</label>
								<input class="form-control" name="avatar" type="file">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Username <span class="text-danger">*</span></label>
								<input class="form-control" name="username" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Email <span class="text-danger">*</span></label>
								<input class="form-control" name="email" type="email">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" name="password" type="password">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Confirm Password</label>
								<input class="form-control" name="password_confirmation" type="password">
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
<!-- /Add User Modal -->

<!-- Edit User Modal -->
<div id="edit_user" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>First Name <span class="text-danger">*</span></label>
								<input class="form-control" value="John" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Last Name</label>
								<input class="form-control" value="Doe" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Username <span class="text-danger">*</span></label>
								<input class="form-control" value="johndoe" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Email <span class="text-danger">*</span></label>
								<input class="form-control" value="johndoe@example.com" type="email">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" type="password">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Confirm Password</label>
								<input class="form-control" type="password">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Phone </label>
								<input class="form-control" value="9876543210" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Role</label>
								<select class="select">
									<option>Admin</option>
									<option>Client</option>
									<option selected>Employee</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Company</label>
								<select class="select">
									<option>Global Technologies</option>
									<option>Delta Infotech</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">  
							<div class="form-group">
								<label>Employee ID <span class="text-danger">*</span></label>
								<input type="text" value="FT-0001" class="form-control floating">
							</div>
					   </div>
					</div>
					<div class="table-responsive m-t-15">
						<table class="table table-striped custom-table">
							<thead>
								<tr>
									<th>Module Permission</th>
									<th class="text-center">Read</th>
									<th class="text-center">Write</th>
									<th class="text-center">Create</th>
									<th class="text-center">Delete</th>
									<th class="text-center">Import</th>
									<th class="text-center">Export</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Employee</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
								</tr>
								<tr>
									<td>Holidays</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
								</tr>
								<tr>
									<td>Leaves</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
								</tr>
								<tr>
									<td>Events</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
									<td class="text-center">
										<input checked="" type="checkbox">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit User Modal -->
<x-modals.delete :route="'users'" :title="'User'" />
@endsection


@section('scripts')
	<!-- Datatable JS -->
	<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

@endsection	


