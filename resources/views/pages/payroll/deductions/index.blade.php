@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Payroll') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Deductions') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a data-url="{{ route('deductions.create') }}" href="javascript:void(0)" class="btn add-btn"
                        data-ajax-modal="true"
                        data-size="md" data-title="{{ __('Add Deduction') }}">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Deduction') }}
                    </a>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->


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
    </div>
@endsection


@push('page-scripts')

@endpush

