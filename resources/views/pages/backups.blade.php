@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Backups') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Backups') }}
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-12">
                <livewire:laravel_backup_panel::app />
            </div>
        </div>

    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->
    <!-- /Page Js -->
@endpush
