@extends('layouts.auth')

@section('form')
    <h3 class="account-title">{{ __('Reset Password') }}</h3>
    <p class="account-subtitle">{{ __('Fill the form to continue') }}</p>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="$token">
        <x-form.input-block>
            <x-form.label>{{ __('Email Address') }}</x-form.label>
            <x-form.input type="email" name="email" tabindex="1" value="{{ old('email', request()->email) }}"
                placeholder="example@smarthr.com" />
        </x-form.input-block>
        <x-form.input-block>
            <div class="row align-items-center">
                <div class="col">
                    <x-form.label>{{ __('New Password') }}</x-form.label>
                </div>
            </div>
            <div class="position-relative">
                <x-form.input type="password" id="password" name="password" tabindex="3"
                    placeholder="*****************" />
                <span class="fa-solid fa-eye-slash toggle-password"></span>
            </div>
        </x-form.input-block>
        <x-form.input-block>
            <div class="row align-items-center">
                <div class="col">
                    <x-form.label>{{ __('Confirm Password') }}</x-form.label>
                </div>
            </div>
            <div class="position-relative">
                <x-form.input type="password" id="password_confirmation" name="password_confirmation" tabindex="3"
                    placeholder="*****************" />
                <span class="fa-solid fa-eye-slash" id="toggle-password"></span>
            </div>
        </x-form.input-block>
        <x-form.input-block class="text-center">
            <x-form.button>{{ __('Reset Password') }}</x-form.button>
        </x-form.input-block>
        @if (Route::has('login'))
            <div class="account-footer">
                <p>{{ __('Remember your password?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
            </div>
        @endif
    </form>
@endsection
