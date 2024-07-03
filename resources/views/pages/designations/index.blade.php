@extends('layouts.app')

@push('page-styles')

@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Designations') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Designations') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0)" data-url="{{ route('designations.create') }}" class="btn add-btn"
                        data-ajax-modal="true"
                        data-size="md" data-title="Add Designation">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Designation') }}
                    </a>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <!-- Search Filter -->

        <!-- /Search Filter -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-striped custom-table w-100']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-scripts')
@vite([
    'resources/css/datatables.scss',
    'resources/assets/js/jquery.dataTables.min.js',
    'resources/assets/js/dataTables.bootstrap4.min.js'
])
{!! $dataTable->scripts(attributes: ['type' => 'module', 'defer' => true]) !!}
@endpush