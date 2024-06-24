@extends('layouts.auth')

@section('form')
    <h3 class="account-title">{{ __('OTP') }}</h3>
    <p class="account-subtitle">{{ __('Verification your account') }}</p>

    <form action="#" method="POST">
        @csrf
        <div class="otp-wrap">
            <x-form.input name="email" placeholder="0" maxlength="1" class="otp-input" />
            <x-form.input name="email" placeholder="0" maxlength="1" class="otp-input" />
            <x-form.input name="email" placeholder="0" maxlength="1" class="otp-input" />
            <x-form.input name="email" placeholder="0" maxlength="1" class="otp-input" />
        </div>

        <x-form.input-block class="text-center">
            <x-form.button>{{ __('Enter') }}</x-form.button>
        </x-form.input-block>
        @if (Route::has('login'))
            <div class="account-footer">
                <p>{{ __('Not yet received?') }} <a href="javascript:void(0);">{{ __('Resend OTP') }}</a></p>
            </div>
        @endif
    </form>
@endsection
