@extends('layouts.app')



@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Tickets') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Tickets') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0)" data-url="{{ route('tickets.create') }}" class="btn add-btn" data-ajax-modal="true"
                        data-size="lg" data-title="{{ __('Add Ticket') }}">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Ticket') }}
                    </a>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->
        

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
    "resources/js/datatables.js",
    "resources/assets/css/ckeditor.css",
    "resources/js/ckeditor.js"
])
{!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush