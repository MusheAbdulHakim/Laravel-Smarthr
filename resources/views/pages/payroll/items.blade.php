@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Payroll Items') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Payroll') }}
                </li>
            </ul>
           
        </x-breadcrumb>
        <!-- /Page Header -->

        <!-- Page Tab -->
        <div class="page-menu">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab_additions">Additions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab_deductions">Deductions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Tab -->
        
        <!-- Tab Content -->
        <div class="tab-content">
        
            <!-- Additions Tab -->
            <div class="tab-pane show active" id="tab_additions">
            
                <!-- Add Addition Button -->
                <div class="text-end mb-4 clearfix">
                    <button class="btn btn-primary add-btn" type="button" 
                    data-ajax-modal="true" data-url="{{ route('allowances.create') }}"
                    data-size="md" data-title="{{ __('Add Allowance') }}"><i class="fa-solid fa-plus"></i> {{ __('Add Allowance') }}</button>
                </div>
                <!-- /Add Addition Button -->

                <!-- Payroll Additions Table -->
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-hover table-radius">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th class="text-end">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($allowances))
                                    @foreach ($allowances as $allowance)
                                    <tr>
                                        <th>{{ $allowance->name }}</th>
                                        <td>{{ LocaleSettings('currency_symbol').' '. $allowance->amount }}</td>
                                        @include('pages.payroll.allowances.actions', ['id' => $allowance->id])
                                    </tr>                                    
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Payroll Additions Table -->
                
            </div>
            <!-- Additions Tab -->

            
            <!-- Deductions Tab -->
            <div class="tab-pane" id="tab_deductions">
            
                <!-- Add Deductions Button -->
                <div class="text-end mb-4 clearfix">
                    <button class="btn btn-primary add-btn" type="button" 
                    data-ajax-modal="true" data-url="{{ route('deductions.create') }}"
                    data-size="md" data-title="{{ __('Add Deduction') }}"><i class="fa-solid fa-plus"></i> {{ __('Add Deduction') }}</button>
                </div>
                <!-- /Add Deductions Button -->

                <!-- Payroll Deduction Table -->
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-hover table-radius">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th class="text-end">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($deductions))
                                    @foreach ($deductions as $deduction)
                                    <tr>
                                        <th>{{ $deduction->name }}</th>
                                        <td>{{ LocaleSettings('currency_symbol').' '. $deduction->amount }}</td>
                                        @include('pages.payroll.deductions.actions', ['id' => $deduction->id])
                                    </tr>                                    
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Payroll Deduction Table -->
                
            </div>
            <!-- /Deductions Tab -->
            
        </div>
        <!-- Tab Content -->
    </div>
@endsection


@push('page-scripts')

@endpush

