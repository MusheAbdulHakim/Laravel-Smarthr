<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Payslips {{ $date }} </title>




  
  <style type="text/css">
    .page-break {
      page-break-after: always;
    }

    body {
      position: relative;
      width: auto;
      height: 29.7cm;
      color: #001028;
      background: #FFFFFF;
      font-size: 14px;
      font-family: 'helvetica';
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }

    table th,
    table td {
      text-align: center;
    }

    table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table td {
      padding: 10px;
      text-align: left;
    }

    .text-center {
      text-align: center;
    }

    .border-top-bootom-1 {
      border-top: 1px solid #C1CED9;
      border-bottom: 1px solid #C1CED9;
    }

    .py-4 {
      padding-top: 16px;
      padding-bottom: 16px;
    }

    .my-4 {
      margin-top: 16px;
      margin-bottom: 16px;
    }

    .px-4 {
      padding-left: 16px;
      padding-right: 16px;
    }

    .mx-4 {
      margin-left: 16px;
      margin-right: 16px;
    }

    .row-inline-block {
      display: inline-block;
    }

    .row>.col-4 {
      width: 33%;
      display: inline-block;
    }

    .row>.col-6 {
      width: 49%;
      display: inline-block;
    }

    .border-1 {
      border: 1px solid #C1CED9;
    }

    .text-right {
      text-align: right;
    }

    .block {
      text-align: right;
    }

    .block p {
      width: 50%;
    }

    .column {
      float: left;
      width: 50%;
    }

    /* Clear floats after the columns */
    .row-css:after {
      content: "";
      display: table;
      clear: both;
    }
  </style>
</head>

<body>


      <br>
    
  <div class="card border-1">
    <div class="card-header">
    <h2 class="text-center border-top-bootom-1 py-4">{{app(App\Settings\CompanySettings::class)->company_name}} - EMPLOYEE PAYMENT SLIPS</h2>
    <h3 class="text-center border-top-bootom-1 py-4">{{app(App\Settings\CompanySettings::class)->address}}</h3>
    <center>
        <!--
    <img src="{{!empty(app(App\Settings\InvoiceSettings::class)->logo) ? asset('storage/settings/'.app(App\Settings\InvoiceSettings::class)->logo):asset('assets/img/logo2.png')}}" class="inv-logo" alt="logo">
-->
</center>
    <h2 class="text-center border-top-bootom-1 py-4">{{ $payDay }}</h2>
    </div>
    <div class="card-body border">


      <div class="row">
        <div class="col-12 table-responsive">
          <table cellspacing="0" cellpadding="3" class="table">
            <tr>
              <td width="25%" align="right">Employee Name: </td>
              <td width="25%"><b>{{ $payslip->firstname." ".$payslip->lastname }}</b></td>
              <td width="25%" align="right">Department: </td>
              <td width="25%" align="right">{{ $payslip->department->name }}</td>
            </tr>
            <tr>
              <td width="25%" align="right">Employee ID: </td>
              <td width="25%">{{ $payslip->uuid }}</td>
              <td width="25%" align="right">Position: </td>
              <td width="25%" align="right">{{ $payslip->designation->name }}</td>
            </tr>
            <tr>

              <td width="25%" align="right"><b>Basic Pay: </b></td>
              <td width="25%" align="right"><b>K{{ number_format($salarie->salary_amount,2) }}</b></td>
              <td><b>Deductions</b></td>
              <td><b>Allowances</b></td>
            </tr>

            @php

            $total_overtime_amount = 0;
            foreach($overtimes as $ov){
            $total_overtime_amount += (1.5 * ($salarie->$salarie->salary_amount * (12/ 2080)) * (is_null($ov->hours)) || empty($ov->hours) ? 0 : $ov->hours);
            }


           @endphp

            <tr>


              <td></td>
              <td></td>
              <td width="25%" align="right">

              </td>
              <td width="25%" align="right">
              @if($salarie->housing_allowance != 0)
                <p>Housing: K{{$salarie->housing_allowance}}</p>
                
                @endif
                @if($salarie->transport_allowance != 0)
                <p>Transport: K{{$salarie->transport_allowance}}</p>
                
                @endif

                @if($salarie->lunch_allowance != 0)
                <p>Lunch: K{{$salarie->lunch_allowance}}</p>
                
                @endif

                @if($total_overtime_amount != 0)
                <p>Overtime:K{{ number_format($total_overtime_amount,2) }}</p>
                @endif

                



              </td>
            </tr>
           
            <tr>
              <td></td>
              <td></td>
             
              <td width="25%" align="right"><b>Total:</b> 0.00 </td>
              <td width="25%" align="right"><b>Gross Pay:</b> K{{ number_format($salarie->salary_amount+$salarie->housing_allowance + $salarie->transport_allowance+$total_overtime_amount+$salarie->lunch_allowance,2) }}</td>
          
           

            </tr>

            <tr>
              <td></td>
              <td></td>
              <td width="25%" align="right"><b>Net Pay:</b></td>
              <td width="25%" align="right"><b>
              
              K{{ number_format($salarie->salary_amount+$salarie->housing_allowance + $salarie->transport_allowance+$total_overtime_amount+$salarie->lunch_allowance,2) }}
               
            
                </b></td>
            </tr>
          </table>
         
<!-- Insert Data in the Database--> 
<div style="display: none;">




{{\App\Models\PayrollHistory::updateOrCreate([
    
    
    'monthYear'   => $monthYear
],  
  [
  'employee_name' => $payslip->firstname." ".$payslip->lastname,
  'employee_id' => $payslip->uuid, 
  'monthYear' => $monthYear, 
  'department'=>$payslip->department->name,
  'designation'=>$payslip->designation->name,
  'net'=>number_format($salarie->salary_amount+$salarie->housing_allowance + $salarie->transport_allowance+$total_overtime_amount+$salarie->lunch_allowance,2),  
  ])
}}
</div> 


<!--End Insert Data--> 

          <hr>
        </div>
      </div>
            
    </div>
  </div>
</body>

</html>