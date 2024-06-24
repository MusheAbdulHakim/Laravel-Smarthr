@extends('layouts.auth')

@section('form')
    <!-- Lock User Img -->
    <div class="lock-user">
        <img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="User Image" class="rounded-circle">
        <h4>{{ __('John Doe') }}</h4>
    </div>
    <!-- /Lock User Img -->
    <form action="{{ route('password.request') }}" method="POST">
        @csrf
        <x-form.input-block>

            <div class="row align-items-center">
                <div class="col">
                    <x-form.label>{{ __('Password') }}</x-form.label>
                </div>
            </div>
            <div class="position-relative">
                <x-form.input type="password" id="password" name="password" tabindex="2"
                    placeholder="*****************" />
                <span class="fa-solid fa-eye-slash" id="toggle-password"></span>
            </div>
        </x-form.input-block>

        <x-form.input-block class="text-center">
            <x-form.button>{{ __('Enter') }}</x-form.button>
        </x-form.input-block>
        @if (Route::has('login'))
            <div class="account-footer">
                <p>{{ __('Sign in as a different user?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
            </div>
        @endif
    </form>
@endsection
