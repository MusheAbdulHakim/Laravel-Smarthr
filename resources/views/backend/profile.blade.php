@extends('layouts.backend')

@section('styles')
	
@endsection

@section('page-header')
<div class="row">
	<div class="col-sm-12">
		<h3 class="page-title">Profile</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Profile</li>
		</ul>
	</div>
</div>
@endsection


@section('content')
<div class="card mb-0">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="profile-view">
					<div class="profile-img-wrap">
						<div class="profile-img">
							<a href="#"><img alt="avatar" src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar) : asset('assets/img/user.jpg') }}"></a>
						</div>
					</div>
					<div class="profile-basic">
						<div class="row">
							<div class="col-md-5">
								<div class="profile-info-left">
									<h3 class="user-name m-t-0 mb-0">{{auth()->user()->name}}</h3>
									
								</div>
							</div>
							<div class="col-md-7">
								<ul class="personal-info">
									<li>
										<div class="title">Username:</div>
										<div class="text">{{auth()->user()->username}}</div>
									</li>
									<li>
										<div class="title">Email:</div>
										<div class="text">{{auth()->user()->email}}</div>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Profile Modal -->
<div id="profile_info" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Profile Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" action="{{route('profile')}}">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="profile-img-wrap edit-img">
								<img class="inline-block" src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar) : asset('assets/img/user.jpg') }}" alt="user">
								<div class="fileupload btn">
									<span class="btn-text">edit</span>
									<input name="avatar" class="upload" type="file">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" class="form-control" name="name" value="{{auth()->user()->name}}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label> Username</label>
										<input type="text" class="form-control" name="username" value="{{auth()->user()->username}}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" name="email" value="{{auth()->user()->email}}">
									</div>
								</div>
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
<!-- /Profile Modal -->
@endsection

@section('scripts')
	
@endsection
