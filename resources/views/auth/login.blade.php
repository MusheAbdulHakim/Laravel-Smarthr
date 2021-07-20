@extends('layouts.auth')

@section('content')
@if(session('login_error'))
<div class="bg-danger p-3 rounded text-center mb-2 text-sm text-white">
    {{session('login_error')}}
</div>
@endif
<form action="{{route('login')}}" method="post">
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
    <div class="form-group">
        <div class="row">
            <div class="col">
                <label>Password</label>
            </div>
            <div class="col-auto">
                <a class="text-muted" href="{{route('forgot-password')}}">
                    Forgot password?
                </a>
            </div>
        </div>
        <input name="password" class="form-control  @error('password') border-danger @enderror" type="password">
        
    </div>
    @error('password')
    <div class="bg-danger text-sm text-white p-3 rounded mb-2">
        {{$message}}
    </div>
    @enderror
    <div class="form-group text-center">
        <button class="btn btn-primary account-btn" type="submit">Login</button>
    </div>
    <div class="account-footer">
        <p>Don't have an account yet? <a href="{{route('register')}}">Register</a></p>
    </div>
</form>
@endsection