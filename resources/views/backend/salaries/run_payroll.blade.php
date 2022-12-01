@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    td.p-0 img.img-thumbnail{
      width: 140px;
    }
    button.h-33{
      height: 33px !important;
    }
    .divHide{
      display: none;
    }
</style>
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Employee Payroll</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Payroll</li>
		</ul>
	</div>
	
</div>
@endsection

@section('content')
<!--data here-->
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade active show" id="live" role="tabpanel" aria-labelledby="pills-timeline-tab">

    <!--Live Overtime Data-->
    <div class="card-header">
      <div class="col-md-3 d-block">
        <button class="btn btn-sm btn-dark float-left" onclick="loading();" id="pdfBtnPrintpayroll"><i class="ik ik-printer"></i> PAYROLL</button>
        
      </div>

        <br><br>  
<!--Calendar strats here--> 

<div class="col-md-6">
        <div class="input-group mb-0">
          <span class="input-group-prepend">
          <label class="input-group-text"><i class="fa fa-calendar"></i></label>
          </span>
          <input type="text" class="form-control form-control-bold text-center" placeholder="From date - To date" id="date">
          <span class="input-group-append">
            <label class="input-group-text"><i class="fa fa-calendar"></i></label>
          </span>
        </div>
      </div>




    </div>
    

<div id="payroll_response"></div>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Employee ID</th>
						<th>Email</th>
						<th>Mobile</th>
						<th class="text-nowrap">Salary</th>
						
						
					</tr>
				</thead>
				<tbody>
					@foreach ($employees as $employee)
					<tr>
						<td>
							<h2 class="table-avatar">
								<a href="javascript:void(0)" class="avatar"><img alt="avatar" src="@if(!empty($employee->avatar)) {{asset('storage/employees/'.$employee->avatar)}} @else assets/img/profiles/default.jpg @endif"></a>
								<a href="javascript:void(0)">{{$employee->employee->firstname}} {{$employee->employee->lastname}}</a>
							</h2>
						</td>
						<td>{{$employee->employee->uuid}}</td>
						<td>{{$employee->employee->email}}</td>
						<td>{{$employee->employee->phone}}</td>
						
						<td>
                        {{$employee->salary_currency}} {{$employee->salary_amount}}
						</td>
						
					</tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
	</div>
</div>
    <!--End Live Overtime Data-->

  </div>
</div>
<!--End data here-->

<div class="divHide">
  <form id="payslipForm">
    
    <input type="text" name="date" id="payslip_date_input">
    
  </form>
  
</div>


<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
<script type="text/javascript">


// get data from serve ajax

function printForm(formId,btn){
  
  $.ajax({
    url: $(formId),//.data('action'),
    type: "GET",
   // data : new FormData($(formId)[0]),
    processData: false,
    contentType: false,
    beforeSend:function(){
      btn.prop("disabled",true);
    },
    complete : function(){
           btn.prop('disabled',false);
    }
  });
}

$(document).ready(function() {
  
  var crntDate = moment().format('MMMM DD, YYYY');
  var lastDate = moment().subtract(30, 'days').format('MMMM DD, YYYY');
  var date = crntDate - lastDate;
  var datePickerPlug = $('#date').daterangepicker({
    "startDate": lastDate,
    "endDate": crntDate,
    locale: {format: 'MMMM DD, YYYY'},
  });
  

  
  

  var inputDate = $("#date").val();
  
  $("#payslip_date_input").val(inputDate);

  datePickerPlug.on('apply.daterangepicker', function(ev, picker) {
      var date = picker.startDate.format("MMMM DD, YYYY")+" - "+picker.endDate.format("MMMM DD, YYYY");
      $("#payroll_date_input,#payslip_date_input").val(date);


      table.ajax.reload();
  });

  $("#pdfBtnPrintpayslilp,#pdfBtnPrintpayroll").on("click",function(e){
   
   
    $.ajax({
            type: 'GET',
            url: "{{ route('compile_payroll') }}",
            data: $("#payslipForm").serialize(),
            xhrFields: {
                responseType: 'application/json'
            },
            success: function(response){
              alert(response.message);
              
            },
            error: function(response){
              alert(response.message);
            }
        });





     
        });

     
     //download-payroll







  
});

</script>

@endsection
