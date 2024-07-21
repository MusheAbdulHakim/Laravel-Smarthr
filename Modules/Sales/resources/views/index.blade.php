@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Page Title') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">{!! config('sales.name') !!}</a>
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->

    <h5>{!! config('sales.name') !!}</h5>

    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->
    <!-- /Page Js -->
@endpush
