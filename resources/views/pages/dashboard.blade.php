@extends('layouts.app')

@push('page-styles')
    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Welcome') }}
                {{ !empty(auth()->user()->username) ? auth()->user()->username . ' !' : '' }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->



    </div>
@endsection


@push('page-scripts')
    <!-- Chart JS -->
    {{-- @vite([
        'resources/assets/plugins/morris/morris.min.js',
        'resources/assets/plugins/raphael/raphael.min.js'
    ]) --}}
@endpush
