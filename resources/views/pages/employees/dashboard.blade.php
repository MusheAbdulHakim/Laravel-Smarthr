@extends('layouts.app')

@push('page-styles')
    
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
   
@endpush
