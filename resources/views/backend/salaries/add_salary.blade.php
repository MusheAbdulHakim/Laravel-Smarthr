@extends('layouts.backend')

@section('styles')

@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Salaries</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Salary Scales</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salarie"><i class="fa fa-plus"></i> Add Salarie</a>
		<div class="view-icons">
			<a href="{{route('salary_scale.index')}}" class="grid-view btn btn-link {{route_is('salary_scale.index') ? 'active' : '' }}"><i class="fa fa-th"></i></a>
			<a href="{{route('salary_scale.index')}}" class="list-view btn btn-link {{route_is('salary_scale.show') ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection

@section('content')


<div class="row staff-grid-row">
	@if (!empty($salaries->count()))
		@foreach ($salaries as $salarie)
			<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
				<div class="profile-widget">
					<div class="profile-img">
						<a href="javascript:void(0)" class="avatar"><img alt="" src="@if(!empty($salarie->avatar)) {{asset('storage/salaries/'.$salarie->avatar)}} @else assets/img/profiles/default.jpg @endif"></a>
					</div>
					<div class="dropdown profile-action">
						<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a data-id="{{$salarie->id}}" data-salary_scale="{{$salarie->salary_scale}}" data-salary_amount="{{$salarie->salary_amount}}" data-avatar="{{$salarie->avatar}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						<a data-id="{{$salarie->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
					</div>
					</div>
					<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$salarie->salary_scale}}</a></h4>
					<h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$salarie->salary_amount}}</a></h5>
					
				</div>
			</div>
		@endforeach
		<x-modals.delete :route="'salarie_scale.destroy',encrypt($salarie->id)" :title="'salarie'" />

		<!-- Edit salarie Modal -->
		<div id="edit_salarie" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit salarie</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" enctype="multipart/form-data" action="{{route('salarie_scale.update')}}">
							@csrf
							@method("PUT")
                            <div class="row">
                    <div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Salary Scale</label>
								<input name="salary_scale" class="form-control" placeholder="e.g pay grade 1" type="number">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Salary amount</label>
								<input name="salary_amount" class="form-control" placeholder="e.g $4500" type="number">
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
		<!-- /Edit salarie Modal -->
	@endif
	
</div>

<!-- Add salarie Modal -->
<div id="add_salarie" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Employee Salarie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" action="{{route('salary_scale.store')}}">
					@csrf
					<div class="row">
                    <div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Salary Scale</label>
								<input name="salary_scale" class="form-control" placeholder="e.g pay grade 1" type="text">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Corresponding Salary amount</label>
								<input name="salary_amount" class="form-control" placeholder="e.g $4500" type="number">
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
<!-- /Add salarie Modal -->
@endsection

@section('scripts')
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_salarie').modal('show');
			var id = $(this).data('id');
			var salary_amount = $(this).data('salary_amount');
			var salary_grade = $(this).data('salary_grade');
			

			$('#edit_id').val(id);
			$('.edit_salary_amount').val(salary_amount);
			$('.edit_salary_grade').val(salary_grade);
		
		})
	})
</script>
@endsection
