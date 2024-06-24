@extends('layouts.auth')

@section('form')
    <h3 class="account-title">{{ __('Forgot Password?') }}</h3>
    <p class="account-subtitle">{{ __('Enter your email to get a password reset link') }}</p>

    <form action="{{ route('password.request') }}" method="POST">
        @csrf
        <x-form.input-block>
            <x-form.label>{{ __('Email Address') }}</x-form.label>
            <x-form.input type="email" name="email" tabindex="1" value="{{ old('email') }}"
                placeholder="example@smarthr.com" />
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
