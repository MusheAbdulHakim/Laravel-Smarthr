@extends('layouts.blank', ['bodyClass' => 'account-page'])

@section('content')
    <div class="account-content">
        <div class="container">

            <!-- Account Logo -->
            <div class="account-logo">
                <a href="{{ url('/') }}"><img src="{{ Vite::asset('resources/assets/img/logo2.png') }}" alt="Dreamguy's Technologies"></a>
            </div>
            <!-- /Account Logo -->

            <div class="account-box">
                <div class="account-wrapper">
                    @yield('form')
                </div>
            </div>
        </div>
    </div>
@endsection
