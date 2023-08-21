@extends('layouts/loginRegisterLayout')
@section('content-section')
<h2 class="mb-3">Login</h2>

<form action="{{Route('login')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" name="email"/>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" />
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
        <input type="submit" name="submit" value="Login" class="btn btn-primary" />
</form>
    <div class="mt-3">
        <p>Don't have an account? <a href="{{route('register')}}">Register</a></p>
    </div>

@if(Session::has('error'))
    <span><p style="color:red">{{Session::get('error')}}</p><span>
@endif()
@endsection