@extends('layouts.app')

@section('sidebar')
    <x-custom-sidebar>
        {!! renderAppSettingsMenu() !!}
    </x-custom-sidebar>
@endsection

@section('page-content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @yield('page-header-section')
                @yield('page-section')
            </div>
        </div>
    </div>
@endsection
