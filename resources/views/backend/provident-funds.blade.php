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
		<h3 class="page-title">Provident Funds</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Provident Funds</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_pf"><i class="fa fa-plus"></i> Add Tax</a>
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
                        <th>Employee Name</th>
                        <th>Provident Fund Type</th>
                        <th>Employee Share</th>
                        <th>Organization Share</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($provident_funds as $fund)   
                    <tr>
                        <td>
                            <h2 class="table-avatar">
                                <a href="javascript:void(0)" class="avatar"><img alt=""  src="{{!empty($fund->employee->avatar) ? asset('storage/employees/'.$fund->employee->avatar): asset('assets/img/profiles/avatar-02.jpg')}}"></a>
                                <a href="javascript:void(0)">{{$fund->employee->firstname.' '.$fund->employee->lastname}} <span>{{$fund->employee->designation->name}}</span></a>
                            </h2>
                        </td>
                        <td>{{$fund->type}}</td>
                        <td>{{$fund->employee_share_percent}}%</td>
                        <td>{{$fund->org_share_percent}}%</td>
                        
                        <td class="text-end">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editbtn" href="javascript:void(0)" data-id="{{$fund->id}}" data-employee="{{$fund->employee_id}}"
                                        data-type="{{$fund->type}}" data-emp_amount="{{$fund->employee_share_amount}}" 
                                        data-emp_percent="{{$fund->employee_share_percent}}" data-org_amount="{{$fund->org_share_amount}}"
                                        data-org_percent="{{$fund->org_share_percent}}" data-description="{{$fund->description}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item deletebtn" href="javascript:void(0)" data-id="{{$fund->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

<!-- Add PF Modal -->
<div id="add_pf" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Provident Fund</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('provident-fund')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <select class="form-control select" name="employee">
                                    @foreach (\App\Models\Employee::get() as $employee)
                                        <option value="{{$employee->id}}">{{$employee->firstname.' '.$employee->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Provident Fund Type</label>
                                    <select class="form-control select" name="type">
                                    <option value="Fixed">Fixed Amount</option>
                                    <option value="Percentage">Percentage of Basic Salary</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="show-fixed-amount">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Employee Share (Amount)</label>
                                            <input class="form-control" name="emp_amount" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Organization Share (Amount)</label>
                                            <input class="form-control" name="org_amount" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="show-basic-salary">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Employee Share (%)</label>
                                            <input class="form-control" name="emp_percent" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Organization Share (%)</label>
                                            <input class="form-control" name="org_percent" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="4"></textarea>
                            </div>
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
<!-- /Add PF Modal -->

<!-- Edit PF Modal -->
<div id="edit_pf" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Provident Fund</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('provident-fund')}}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <select class="form-control select" id="edit_employee" name="employee">
                                    @foreach (\App\Models\Employee::get() as $employee)
                                        <option value="{{$employee->id}}">{{$employee->firstname.' '.$employee->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Provident Fund Type</label>
                                <select class="form-control select" id="edit_type" name="type">
                                    <option value="Fixed">Fixed Amount</option>
                                    <option value="Percentage">Percentage of Basic Salary</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="show-fixed-amount">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Employee Share (Amount)</label>
                                            <input class="form-control" id="edit_empamount" name="emp_amount" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Organization Share (Amount)</label>
                                            <input class="form-control" id="edit_orgamount" name="org_amount" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="show-basic-salary">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Employee Share (%)</label>
                                            <input class="form-control" id="edit_emppercent" name="emp_percent" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Organization Share (%)</label>
                                            <input class="form-control" id="edit_orgpercent" name="org_percent" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="edit_description" class="form-control" name="description" rows="4"></textarea>
                            </div>
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
<!-- /Edit PF Modal -->

<x-modals.delete :route="'provident-fund'" :title="'Provident Fund'" />
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
                var employee = $(this).data('employee');
                var type = $(this).data('type');
                var description = $(this).data('description');
                var employee_amount = $(this).data('emp_amount');
                var employee_percent = $(this).data('emp_percent');
                var org_amount = $(this).data('org_amount');
                var org_percent = $(this).data('org_percent');
 
                $('#edit_pf').modal('show');
                $('#edit_id').val(id);
                $('#edit_employee').val(employee).trigger('change');;
                $('#edit_type').val(type).trigger('change');
                $('#edit_empamount').val(employee_amount);
                $('#edit_emppercent').val(employee_percent);
                $('#edit_orgamount').val(org_amount);
                $('#edit_orgpercent').val(org_percent);
                $('#edit_description').val(description);
            }));
        });
    </script>
@endsection