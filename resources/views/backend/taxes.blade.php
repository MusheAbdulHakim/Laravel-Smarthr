@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Taxes</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Taxes</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_tax"><i class="fa fa-plus"></i> Add Tax</a>
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
                        <th>#</th>
                        <th>Tax Name </th>
                        <th>Tax Percentage (%) </th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($taxes as $tax)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$tax->name}}</td>
                        <td>{{$tax->percentage}}%</td>
                        <td>
                            {{ucfirst($tax->status)}}
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editbtn" href="javascript:void(0)" data-id="{{$tax->id}}" data-name="{{$tax->name}}" data-percent="{{$tax->percentage}}" data-status="{{$tax->status}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item deletebtn" href="javascript:void(0)" data-id="{{$tax->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        
                    </tr>
                    @php
                        $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Tax Modal -->
<div id="add_tax" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Tax</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('taxes')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tax Name <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text">
                    </div>
                    <div class="form-group">
                        <label>Tax Percentage (%) <span class="text-danger">*</span></label>
                        <input class="form-control" name="percentage" type="text">
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Tax Modal -->

<!-- Edit Tax Modal -->
<div id="edit_tax" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tax</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('taxes')}}" method="post">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Tax Name <span class="text-danger">*</span></label>
                        <input class="form-control" id="edit_name" name="name" type="text">
                    </div>
                    <div class="form-group">
                        <label>Tax Percentage (%) <span class="text-danger">*</span></label>
                        <input class="form-control" id="edit_percent" name="percentage" type="text">
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="select" id="edit_status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Tax Modal -->

<x-modals.delete :route="'taxes'" :title="'Tax'" />
@endsection


@section('scripts')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.table').on('click','.editbtn',(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var percent = $(this).data('percent');
            var status = $(this).data('status');
            $('#edit_tax').modal('show');
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_percent').val(percent);
            $('#edit_status').val(status).trigger('change');
        }));
    });
</script>
@endsection