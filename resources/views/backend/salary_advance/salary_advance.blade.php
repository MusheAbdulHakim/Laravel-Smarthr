@extends('layouts.backend')

@section('styles')

@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Salary Advances</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Salary Advance</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary_advance"><i class="fa fa-plus"></i> Add Salary Advance</a>
		<div class="view-icons">
			<a href="{{route('salary_advance.index')}}" class="grid-view btn btn-link {{route_is('salary_scale.index') ? 'active' : '' }}"><i class="fa fa-th"></i></a>
			<a href="{{route('salary_advance.index')}}" class="list-view btn btn-link {{route_is('salary_scale.show') ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection

@section('content')


<div class="row staff-grid-row">
	@if (!empty($salary_advances->count()))
		@forelse ($salary_advances as $salary_advance)
			<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
				<div class="profile-widget">
					<div class="profile-img">
						<a href="javascript:void(0)" class="avatar"><img alt="" src="@if(!empty($salary_advance->avatar)) {{asset('storage/salary_advances/'.$salary_advance->avatar)}} @else assets/img/profiles/default.jpg @endif"></a>
					</div>
					<div class="dropdown profile-action">
						<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a data-id="{{$salary_advance->id}}" data-title="{{$salary_advance->title}}" data-rate_amount="{{$salary_advance->rate_amount}}" data-date="{{$salary_advance->date}}" data-duration="{{$salary_advance->duration}}" data-total_repayments="{{$salary_advance->total_repayments}}"  data-employee_id="{{$salary_advance->employee->firstname}} {{$salary_advance->employee->lastname}}" data-avatar="{{$salary_advance->avatar}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						<a data-id="{{$salary_advance->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
					</div>
					</div>
					<h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">LOAN AMOUNT(S): {{$salary_advance->rate_amount}}</a></h5>
					<h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">REPAYMENTS:{{$salary_advance->total_repayments}}</a></h5>
          <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">REMAINING INSTALLMENTS:{{$salary_advance->duration}}</a></h5>
          <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">LOAN/STATUS: {{$salary_advance->loan_status == 1 ? 'ACTIVE' : 'NOT ACTIVE' }}</a></h5>
					
				</div>
			</div>
			@empty
			No Salary Salary Advance for Your Employee
		@endforelse
		<x-modals.delete :route="'salary_advance.delete'" :title="'salary_advance'" />

		<!-- Edit salary_advance Modal -->
		<div id="edit_salary_advance" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Salary Advance</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" action="{{route('salary_advance.update',encrypt($salary_advance->id))}}">
							@csrf
							@method("PUT")
                            <div class="row">
                      <div class="col-md-8 col-lg-8 col-sm-12">
                       <div class="form-group">
                        <label for="title">Title</label><small class="text-danger">*</small>
                        <input type="text" name="title" placeholder="Some reason for a loan" class="form-control edit_title" id="title" autocomplete="off">
                        <small class="text-danger err" id="title-err"></small>
                      </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="date">Loan Amount</label><small class="text-danger">*</small>
                          <input type="number" name="rate_amount" onkeyup="calculateEMI()" value="{{ old('rate_amount') }}"  class="form-control edit_rate_amount"  id="amount" required>
                          <small class="text-danger err" id="date-err">This is the employee requested loan amount</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="employee_id">Employee</label><small class="text-danger">*</small>
                        <select class="form-control" name="employee_id" id="employee_id">
                          @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->firstname." ".$employee->lastname." (#".$employee->uuid.")" }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="employee_id-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Duration</label><small class="text-danger">*</small>
                        <input type="number"  onkeyup="calculateEMI()" name="duration" value="{{ old('employee_duration') }}" class="form-control edit_duration"  id="installments" required>
                        <small class="text-danger err" id="rate_amount-err">This is the loan duration.</small>
                      </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Total Repayments</label><small class="text-danger">*</small>
                        <input type="text" class="form-control edit_total_repayments" name="total_repayments" value="{{ old('total_repayments') }}"  id="total" readonly>
                        <small class="text-danger err" id="rate_amount-err">This is the total repayment amount.</small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">EMI</label><small class="text-danger">*</small>
                        <input type="text" name="emi" class="form-control edit_emi" value="{{ old('emi') }}" name id="monthly" readonly>
                        <small class="text-danger err" id="rate_amount-err">Equated Monthly Installment</small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="loandate">Date</label><small class="text-danger">*</small>
                        <input type="text" class="form-control datetimepicker-input edit_date" name="date" id="loandate" data-toggle="datetimepicker" data-target="#loandate" >
                      </div>
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="employee_id">Salary Advance Status</label><small class="text-danger">*</small>
                        <select class="form-control" name="status">                          
                            <option value="1">GRANT</option>
                            <option value="0">APPROVE LATER</option>
                          
                        </select>
                        <small class="text-danger err" id="employee_id-err"></small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                       
                      </div>
                    </div>

						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit salary_advance Modal -->
	@endif
	
</div>

<!-- Add salary_advance Modal -->
<div id="add_salary_advance" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Employee Salary Advance</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            
			<div class="modal-body">
				<form method="POST" action="{{route('salary_advance.store')}}">
					@csrf
                    <div class="row">
                      <div class="col-md-8 col-lg-8 col-sm-12">
                       <div class="form-group">
                        <label for="title">Title</label><small class="text-danger">*</small>
                        <input type="text" name="title" placeholder="Some reason for a loan" class="form-control" id="title" autocomplete="off">
                        <small class="text-danger err" id="title-err"></small>
                      </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="date">Loan Amount</label><small class="text-danger">*</small>
                          <input type="number" name="rate_amount" onkeyup="calculateEMI()" value="{{ old('employee_loan_amount') }}"  class="form-control"  id="amount" required>
                          <small class="text-danger err" id="date-err">This is the employee requested loan amount</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="employee_id">Employee</label><small class="text-danger">*</small>
                        <select class="form-control" name="employee_id" id="employee_id">
                          @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->firstname." ".$employee->lastname." (#".$employee->uuid.")" }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="employee_id-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Duration</label><small class="text-danger">*</small>
                        <input type="number"  onkeyup="calculateEMI()" name="duration" value="{{ old('employee_duration') }}" class="form-control"  id="installments" required>
                        <small class="text-danger err" id="rate_amount-err">This is the loan duration.</small>
                      </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Total Repayments</label><small class="text-danger">*</small>
                        <input type="text" class="form-control" name="total_repayments" value="{{ old('employee_total_repayment') }}"  id="total" readonly>
                        <small class="text-danger err" id="rate_amount-err">This is the total repayment amount.</small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">EMI</label><small class="text-danger">*</small>
                        <input type="text" name="emi" class="form-control" value="{{ old('employee_monthly') }}" name id="monthly" readonly>
                        <small class="text-danger err" id="rate_amount-err">Equated Monthly Installment</small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Date</label><small class="text-danger">*</small>
                        <input type="text" class="form-control datetimepicker-input" name="date" id="loandate" data-toggle="datetimepicker" data-target="#loandate" >
                      </div>
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="employee_id">Salary Advance Status</label><small class="text-danger">*</small>
                        <select class="form-control" name="status">                          
                            <option value="1">GRANT</option>
                            <option value="0">APPROVE LATER</option>
                          
                        </select>
                        <small class="text-danger err" id="employee_id-err"></small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                       
                      </div>
                    </div>

				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add salary_advance Modal -->
@endsection

@section('scripts')
<script>
function calculateEMI() {


   

var installments = document.getElementById('installments').value;
if (!installments)
   installments = '0';


   var loan_amount =document.getElementById('amount').value;
if (!loan_amount)
   loan_amount = '0';
   
   
                


var loan_amount = parseFloat(loan_amount);
var loan_percent = 0;
var installments = parseFloat(installments);








var total = (loan_amount)+((loan_amount)*(loan_percent/100)*installments);
document.getElementById('total').value = parseFloat(total).toFixed(2);
document.getElementById('monthly').value = parseFloat((total/installments)).toFixed(2);


}





	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_salary_advance').modal('show');
			var id = $(this).data('id');
      var title = $(this).data('title');
			var rate_amount = $(this).data('rate_amount');
			var date = $(this).data('date');
      var duration = $(this).data('duration');
      var total_repayments = $(this).data('total_repayments');
			var employee_id = $(this).data('employee_id');
			
			

			$('#edit_id').val(id);
			$('.edit_title').val(title);
			$('.edit_rate_amount').val(rate_amount);
      $('#edit_date').val(date);
			$('.edit_duration').val(duration);
			$('.edit_total_repayments').val(total_repayments);
      $('.edit_employee_id').val(employee_id);
		
		});




 




  $('#loandate').datetimepicker({
   format: 'LL'
  });
	})
</script>
@endsection
