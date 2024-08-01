@extends('layouts.app')

@push('page-styles')
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>

        </x-breadcrumb>
        <!-- /Page Header -->


        <livewire:employee-attendance />

    </div>
@endsection


@push('page-scripts')
@endpush
