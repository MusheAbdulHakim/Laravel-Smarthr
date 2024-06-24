@extends('layouts.auth')

@section('form')
    <h3 class="account-title">{{ __('Login') }}</h3>
    <p class="account-subtitle">{{ __('Access to our dashboard') }}</p>

    <!-- Account Form -->
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <x-form.input-block>
            <x-form.label>{{ __('Email Address') }}</x-form.label>
            <x-form.input type="email" name="email" tabindex="1" value="{{ old('email') }}"
                placeholder="example@smarthr.com" />
        </x-form.input-block>

        <x-form.input-block>

            <div class="row align-items-center">
                <div class="col">
                    <x-form.label>{{ __('Password') }}</x-form.label>
                </div>
                <div class="col-auto">
                    <a class="text-muted" href="{{ route('password.email') }}">
                        {{ __('Forgot password?') }}
                    </a>
                </div>
            </div>
            <div class="position-relative">
                <x-form.input type="password" id="password" name="password" tabindex="2"
                    placeholder="*****************" />
                <span class="fa-solid fa-eye-slash" id="toggle-password"></span>
            </div>
        </x-form.input-block>
        <x-form.input-block class="text-center">
            <x-form.button>{{ __('Login') }}</x-form.button>
        </x-form.input-block>
        @if (Route::has('register'))
            <div class="account-footer">
                <p>{{ __("Don't have an account yet?") }} <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
            </div>
        @endif
    </form>
    <!-- /Account Form -->
@endsection
