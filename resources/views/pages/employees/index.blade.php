@extends('layouts.app')

@push('page-style')
    
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Employees') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Employees') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0)" data-url="{{ route('employees.create') }}" class="btn add-btn"
                        data-ajax-modal="true" data-size="lg" data-title="Add Employee">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Employee') }}
                    </a>
                    <div class="view-icons">
                        <a href="{{ route('employees.index') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                        <a href="{{ route('employees.list') }}" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                    </div>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->


        <div class="row staff-grid-row">
            @if (!empty($employees))
                @foreach ($employees as $employee)
                <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                    <div class="profile-widget">
                        <div class="profile-img">
                            <a href="{{ route('employees.show', ['employee' => \Crypt::encrypt($employee->id)]) }}" class="avatar"><img src="{{ !empty($employee->avatar) ? uploadedAsset($employee->avatar,'users'): asset('images/user.jpg') }}" alt="User Image"></a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('employees.edit', ['employee' => \Crypt::encrypt($employee->id)]) }}" data-ajax-modal="true"
                                    data-title="Edit Employee" data-size="lg">
                                    <i class="fa-solid fa-pencil m-r-5"></i>
                                    {{ __('Edit') }}
                                </a>
                                <a class="dropdown-item deleteBtn" data-route="{{ route('employees.destroy', $employee->id) }}" data-title="Delete Employee"
                                    data-question="Are you sure you want to delete?" href="javascript:void(0)">
                                    <i class="fa-regular fa-trash-can m-r-5"></i>
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </div>
                        <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{ route('employees.show', ['employee' => \Crypt::encrypt($employee->id)]) }}">{{ $employee->fullname }}</a></h4>
                        @if (!empty($employee->employeeDetail) && !empty($employee->employeeDetail->designation))
                        <div class="small text-muted">{{ $employee->employeeDetail->designation->name }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection


