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
		<h3 class="page-title">Expenses</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Expenses</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_expense"><i class="fa fa-plus"></i> Add Modal</a>
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
                        <th>Item</th>
                        <th>Purchase From</th>
                        <th>Purchase Date</th>
                        <th>Purchased By</th>
                        <th>Amount</th>
                        <th>Paid By</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)     
                    <tr>
                        <td>
                            <strong>{{$expense->name}}</strong>
                        </td>
                        <td>{{$expense->purchased_from}}</td>
                        <td>{{date_format(date_create($expense->purchased_date),'D M,Y')}}</td>
                        <td>
                            <h2 class="table-avatar">
                                <a href="javascript:void(0)" class="avatar"><img alt=""  src="{{!empty($expense->user->avatar) ? asset('storage/users/'.$expense->user->avatar): asset('assets/img/profiles/avatar-02.jpg')}}"></a>
                                <a href="javascript:void(0)">{{$expense->user->name}}</a>
                            </h2>
                        </td>
                        <td>{{app(app\Settings\ThemeSettings::class)->currency_symbol.' '.$expense->amount}}</td>
                        <td>{{$expense->payment_method}}</td>
                        <td class="text-center">
                            {{$expense->status}}
                        </td>
                        <td class="text-end">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editbtn" href="javascript:void(0)" data-id="{{$expense->id}}" data-user="{{$expense->user_id}}" data-amount="{{$expense->amount}}" 
                                        data-paymethod="{{$expense->payment_method}}" data-status="{{$expense->status}}" data-name="{{$expense->name}}"
                                        data-date="{{$expense->purchased_date}}" data-seller="{{$expense->purchased_from}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item deletebtn" href="javascript:void(0)" data-id="{{$expense->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

<!-- Add Expense Modal -->
<div id="add_expense" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Expense</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('expenses')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item Name</label>
                                <input class="form-control" name="name" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchase From</label>
                                <input class="form-control" name="seller" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchase Date</label>
                                <div class="cal-icon"><input name="date" class="form-control datetimepicker" type="text"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchased By </label>
                                <select class="select" name="user">
                                    @foreach (\App\Models\User::get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input placeholder="50" name="amount" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paid By</label>
                                <select class="select" name="payment_method">
                                    <option>Cash</option>
                                    <option>Cheque</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" name="status">
                                    <option>Pending</option>
                                    <option>Approved</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Attachments</label>
                                <input class="form-control" name="file" type="file">
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
<!-- /Add Expense Modal -->

<!-- Edit Expense Modal -->
<div id="edit_expense" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Expense</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('expenses')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item Name</label>
                                <input class="form-control" id="edit_name" name="name" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchase From</label>
                                <input class="form-control" id="edit_seller" name="seller" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchase Date</label>
                                <div class="cal-icon"><input id="edit_date" name="date" class="form-control datetimepicker" type="text"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchased By </label>
                                <select class="select" id="edit_user" name="user">
                                    @foreach (\App\Models\User::get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input placeholder="50" id="edit_amount" name="amount" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paid By</label>
                                <select class="select" id="edit_paymethod" name="payment_method">
                                    <option>Cash</option>
                                    <option>Cheque</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" id="edit_status" name="status">
                                    <option>Pending</option>
                                    <option>Approved</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Attachments</label>
                                <input class="form-control" name="file" type="file">
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
<!-- /Edit Expense Modal -->

<x-modals.delete :route="'expenses'" :title="'Expense'" />

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
            var user = $(this).data('user');
            var status = $(this).data('status');
            var amount = $(this).data('amount');
            var payment_method = $(this).data('paymethod');
            var seller = $(this).data('seller');
            var date = $(this).data('date');
            $('#edit_expense').modal('show');
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_seller').val(seller);
            $('#edit_date').val(date);
            $('#edit_user').val(user).trigger('change');
            $('#edit_amount').val(amount);
            $('#edit_paymethod').val(payment_method).trigger('change');
            $('#edit_status').val(status).trigger('change');
        }));
    });
</script>
@endsection