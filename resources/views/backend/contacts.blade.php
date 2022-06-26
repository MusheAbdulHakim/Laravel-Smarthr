@extends('layouts.backend')
@section('styles')
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
    <div class="col">
        <h3 class="page-title">Contacts</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Contacts</li>
        </ul>
    </div>
    <div class="col-auto float-right ml-auto">
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_contact"><i class="fa fa-plus"></i> Add Contact</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div>
            <table id="datatable" class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Contact Modal -->
<div class="modal custom-modal fade" id="add_contact" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Contact</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('contacts')}}" method="POST">
					@csrf
					<div class="form-group">
						<label>Name <span class="text-danger">*</span></label>
						<input name="name" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label>Email Address</label>
						<input name="email" class="form-control" type="email">
					</div>
					<div class="form-group">
						<label>Contact Number <span class="text-danger">*</span></label>
						<input name="number" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label class="d-block">Status</label>
						<div class="status-toggle">
							<input name="status" type="checkbox" checked id="contact_status" class="check">
							<label for="contact_status" class="checktoggle">checkbox</label>
						</div>
					</div>
					
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Contact Modal -->
   
<x-modals.delete :route="'contact.destroy'"  :title="'contact'"  /> 
<!-- Edit Contact Modal -->
<div class="modal custom-modal fade" id="edit_contact" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('contacts')}}" method="POST">
                    @csrf
                    @method("PUT")
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input class="form-control edit_name" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="form-control edit_email" type="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Contact Number <span class="text-danger">*</span></label>
                        <input class="form-control edit_number" type="text" name="number" >
                    </div>
                    <div class="form-group">
                        <label class="d-block">Status</label>
                        <div class="status-toggle">
                            <input type="checkbox" id="edit_contact_status" name="status" class="check">
                            <label for="edit_contact_status" class="checktoggle">checkbox</label>
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
<!-- /Edit Contact Modal -->  
@endsection

@section('scripts')
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('contacts')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('.editbtn').on('click',function(){
                $('#edit_contact').modal('show');
                var id = $(this).data('id');
                var name = $(this).data('name');
                var phone = $(this).data('phone');
                var email = $(this).data('email');
                var status = $(this).data('status');
                $('#edit_id').val(id);
                $('.edit_name').val(name);
                $('.edit_email').val(email);
                $('.edit_number').val(phone);
                if(status){
                    $('#edit_contact_status').prop("checked", true);
                }else{
                    $('#edit_contact_status').prop("checked", false);
                }
            });
        });
    </script>
@endsection
