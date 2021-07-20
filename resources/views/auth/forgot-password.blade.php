@extends('layouts.auth')

@section('content')
<form action="{{route('forgot-password')}}" method="POST">
    @csrf
    <div class="form-group">
        <label>Email</label>
        <input name="email" type="text" value="{{old('email')}}" class="form-control @error('email') border-danger @enderror">
    </div>
    @error('email')
    <div class="bg-danger text-sm text-white p-3 rounded mb-2">
        {{$message}}
    </div>
    @enderror
    <div class="form-group text-center">
        <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
    </div>
    <div class="account-footer">
        <p>Remember your password? <a href="{{route('login')}}">Login</a></p>
    </div>
</form>

@endsection