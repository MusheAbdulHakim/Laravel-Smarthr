@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Payslip') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Preview Payslip') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <div class="btn-group btn-group-sm" x-data="{
                        printContent: function(){
                            const originalContents = $('body').html();
                            var printContents = $('#payslipSection').html()
                            $('body').empty().html(printContents);
                            window.print();
                            $('body').html(originalContents);
                    }}">
                        <button class="btn btn-white" onclick='window.location.href="{{ route('payslips.index') }}"'>{{ __('Go Back') }}</button>
                        <button class="btn btn-white" @click="function(){
                            let pWidth = 595.28; // the width of a4
                            let srcWidth = document.querySelector('body > div').scrollWidth;
                            let margin = 18; // narrow margin - 1.27 cm (36);
                            let scale = (pWidth - margin * 2) / srcWidth;
                            const doc = new  jsPDF('p', 'pt', 'a4', true);
                            doc.html(document.getElementById('payslipSection'),{
                                callback: function (doc) {
                                    let totalPages = doc.internal.getNumberOfPages()
                                    {{-- //temporal solution for the blanks pages generated by jspdf --}}
                                    for (var i = 2; i <= totalPages; i++) {
                                        doc.setPage(i);
                                        doc.deletePage(i);
                                        i--;
                                        totalPages--;
                                    }
                                    doc.save('{{ $payslip->ps_id }}.pdf');
                                },
                                html2canvas: {
                                    useCORS: true,
                                    allowTaint: true,
                                    letterRendering: true,
                                    scale: scale,
                                },
                                x: margin,
                                y: margin,
                                autoPaging: 'text',
                                jsPDF: doc,
                            })
                        }">{{ __('PDF') }}</button>
                        <button class="btn btn-white" @click="printContent"><i class="fa-solid fa-print fa-lg"></i> {{ __('Print') }}</button>
                    </div>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <div class="row" id="payslipSection">
            <div class="col-md-12">
                <div class="card">
                    @if (!empty($payslip->title))
                    <h4 class="payslip-title">{{ $payslip->title }}</h4>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            @php
                                $company = app(\App\Settings\CompanySettings::class);
                            @endphp
                            <div class="col-sm-6 m-b-20">
                                <img src="{{ appLogo() }}" class="inv-logo" alt="Logo">
                                 <ul class="list-unstyled">
                                    <li>{{ $company->name }}</li>
                                    <li>{{ $company->address }}</li>
                                    <li>{{ !empty($company->city) ? $company->city.' , ':'' }}{{ !empty($company->province) ? $company->province.' ,' :''.$company->postal_code}}</li>
                                </ul>
                            </div>
                            <div class="col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-uppercase">{{ __('Payslip') }} {{ $payslip->ps_id }}</h3>
                                    <ul class="list-unstyled">
                                        <li>{{ __('Date Created') }}: <span>{{ format_date($payslip->created_at) }}</span></li>
                                        @if ($payslip->type === \App\Enums\Payroll\SalaryType::Hourly)
                                        <li>{{ __('Start Date') }}: <span>{{ format_date($payslip->startDate) }}</span></li>
                                        <li>{{ __('Expiry date') }}: <span>{{ format_date($payslip->expiryDate) }}</span></li>
                                        @endif
                                        @if(!empty($payslip->payslip_date))
                                        <li>{{ __('Salary Month') }}: <span>{{ $payslip->payslip_date }}</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 m-b-20">
                                <ul class="list-unstyled">
                                    <li><h5 class="mb-0"><strong>{{ $payslip->employee->user->fullname }}</strong></h5></li>
                                    <li>{{ $employee->user->address }}</li>
                                    <li><span>{{ $employee->department->name ?? '' }}</span></li>
                                    <li><span>{{ $employee->designation->name ?? '' }}</span></li>
                                    <li>{{ __('Employee ID') }}: {{ $employee->emp_id }}</li>
                                    <li>{{ __('Joining Date') }}: {{ $employee->date_joined }}</li>
                                    <li>{{ $employee->phoneNumber }}</li>
                                    <li><a href="@can('show-Employeeprofile') {{ route('employees.show',['employee' => \Crypt::encrypt($employee->user->id)]) }} @else # @endcan">{{ $employee->user->email }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            @if (!empty($payslip->use_allowance))
                            <div class="col-sm-6">
                                <div>
                                    <h4 class="m-b-10"><strong>{{ __('Allowances') }}</strong></h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            @if (!empty($employee->salaryDetails))
                                            <tr>
                                                <td><strong>{{ __('Base pay') }}</strong> <span class="float-end">{{ $currency }} {{ $employee->salaryDetails->base_salary }}</span></td>
                                            </tr>
                                            @endif
                                            @if (!empty($allowances))
                                                @foreach ($allowances as $allowance)
                                                <tr>
                                                    <td><strong>{{ $allowance->name }}</strong> <span class="float-end">{{ $currency.' '.$allowance->amount }}</span></td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            <tr>
                                                <td><strong>{{ __('Total Allowance') }}</strong> <span class="float-end"><strong>{{ $allowances->sum('amount') ?? 0 }}</strong></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            @if (!empty($payslip->use_deduction))
                            <div class="col-sm-6">
                                <div>
                                    <h4 class="m-b-10"><strong>{{ __('Deductions') }}</strong></h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            @if (!empty($deductions))
                                                @foreach ($deductions as $item)
                                                <tr>
                                                    <td><strong>{{ $item->name }}</strong> <span class="float-end">{{ $currency.' '.$item->amount }}</span></td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            <tr>
                                                <td><strong>{{ __('Total Deductions') }}</strong> <span class="float-end"><strong>{{ $currency.' '. $deductions->sum('amount') ?? 0 }}</strong></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-12">
                                <p><strong>{{ __('Net Pay') }}: {{ $currency .' '.$payslip->net_pay}}</strong> ({{ ucwords(\Number::spell($payslip->net_pay)) }}.)</p>
                                @if ($payslip->type === \App\Enums\Payroll\SalaryType::Hourly)
                                <p><small class="text-info"><strong>{{ __('Net Pay') }} = </strong>{{ __('Total hours for attendance between start and end date multiply by Base Salary') }} + {{ __('Total Allowances') }} - {{ __('Total Deductions') }}</small></p>
                                @endif
                                @if ($payslip->type === \App\Enums\Payroll\SalaryType::Weekly)
                                <p><small class="text-info"><strong>{{ __('Net Pay') }} = </strong>{{ __('Number of weeks multiply by Base Salary') }} + {{ __('Total Allowances') }} - {{ __('Total Deductions') }}</small></p>
                                @endif
                                @if ($payslip->type === \App\Enums\Payroll\SalaryType::Monthly || $payslip->type === \App\Enums\Payroll\SalaryType::Contract)
                                <p><small class="text-info"><strong>{{ __('Net Pay') }} = </strong>{{ __('Base Salary') }} + {{ __('Total Allowances') }} - {{ __('Total Deductions') }}</small></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-scripts')
@endpush