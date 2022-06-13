@extends('layouts.auth')

@section('content')
<form action="index.html">
    <div class="form-group">
        <label>Password</label>
        <input class="form-control @error('password') border-danger @enderror" name="password" type="password">
    </div>
    @error('password')
    <div class="bg-danger text-sm text-white p-3 rounded mb-2">
        {{$message}}
    </div>
    @enderror
    <div class="form-group text-center">
        <button class="btn btn-primary account-btn" type="submit">Enter</button>
    </div>
    <div class="account-footer">
        <p>Sign in as a different user? <a href="{{route('login')}}">Login</a></p>
    </div>
</form>
@endsection