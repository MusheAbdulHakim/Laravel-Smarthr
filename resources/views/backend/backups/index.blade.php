@extends('layouts.backend')


@section('styles')

<link href="{{ asset('vendor/laravel_backup_panel/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/laravel_backup_panel/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/plugins/toastify/src/toastify.css')}}">
@livewireStyles

@endsection

@section('content')

<livewire:laravel_backup_panel::app />

@endsection


@section('scripts')
<script src="{{asset('assets/plugins/toastify/src/toastify.js')}}"></script>
@livewireScripts	
@endsection