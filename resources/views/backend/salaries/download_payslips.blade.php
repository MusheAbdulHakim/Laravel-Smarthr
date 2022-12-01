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
			<li class="breadcrumb-item active">Download Payslips</li>
		</ul>
	</div>
	
</div>
@endsection

@section('content')
<form action="{{ route('download_payslips_compressed') }}" method="POST" >
                 @csrf  
                 <!--Error warning if No Payslips Found-->
@if (Session::has('warning_no_payslips'))
 <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-bell"></i>
        <strong>Hello!</strong> you have some bad feedbacks, 
       
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
             {!! Session::get('warning_no_payslips') !!}
    </div>
 @endif
<hr>
                    <div class="col-12">
                        <div class="form-group">
                          <label for="year">Year </label><small class="text-danger">*</small>
                          <select class="form-control" id="gender" name="year">
                            <option value="" selected value disabled>-- Select Year --</option>
                            <option value="2022">2022</option>
                            
                            
                          </select>
                          <small class="text-danger err" id="year-err"></small>
                        </div>
                      </div>
                   

                      <div class="col-12">
                        <div class="form-group">
                          <label for="month">Month </label><small class="text-danger">*</small>
                          <select class="form-control" id="gender" name="month">
                            <option value="" selected value disabled>-- Select Month --</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>

                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          
                            
                            
                          </select>
                          <small class="text-danger err" id="month-err"></small>
                        </div>                        
                      </div>

                    
                    <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                    
                   
                </form>
@endsection
