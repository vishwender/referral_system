@extends('layouts/loginRegisterLayout')
@section('content-section')
<h2 class="mb-3">Register</h2>
<form action="{{route('registered')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Enter Name:</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name"/>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  id="email" placeholder="Enter EmaiL"/>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="reference_code">Reference Code:</label>
        <input type="text" name="reference_code" class="form-control" id="reference_code" placeholder="Enter Refernce code-(optional)"/>
    </div>
    <div class="form-group">
        <label for="password">Enter Password:</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password"/>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"/>
    </div>
        <input type="submit" name="register" class="btn btn-primary" value="Register"/>
        <a href="{{ route('login') }}" class="btn btn-secondary">Go Back</a>
</form>

@if(Session::has('success'))
    <span><p style="color:green">{{Session::get('success')}}</p><span>
@endif()

@if(Session::has('error'))
    <span><p style="color:red">{{Session::get('error')}}</p><span>
@endif()
@endsection