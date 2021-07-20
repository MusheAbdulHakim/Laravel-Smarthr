@extends('layouts.auth')

@section('content')
<form action="{{route('register')}}" method="post">
    @csrf
    <div class="form-group">
        <label>FullName</label>
        <input name="name" type="text" value="{{old('name')}}" class="form-control @error('name') border-danger @enderror">
    </div>
    @error('name')
    <div class="bg-danger text-sm text-white p-3 rounded mb-2">
        {{$message}}
    </div>
    @enderror
    <div class="form-group">
        <label>Username</label>
        <input name="username" type="text" value="{{old('username')}}" class="form-control  @error('username') border-danger @enderror">
    </div>
    @error('username')
    <div class="bg-danger text-sm text-white p-3 rounded mb-2">
        {{$message}}
    </div>
    @enderror
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
        <label>Password</label>
        <input name="password" class="form-control  @error('password') border-danger @enderror" type="password">
    </div>
    @error('password')
    <div class="bg-danger text-sm text-white p-3 rounded mb-2">
        {{$message}}
    </div>
    @enderror
    <div class="form-group">
        <label>Repeat Password</label>
        <input name="password_confirmation" class="form-control" type="password">
    </div>
    
    <div class="form-group text-center">
        <button class="btn btn-primary account-btn" type="submit">Register</button>
    </div>
    <div class="account-footer">
        <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
    </div>
</form>
@endsection