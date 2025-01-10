@extends('layout.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 500px; border-radius: 10px;">
            <h1 class="text-center">Login</h1>
            @if (session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @elseif (session('fail'))
                <div class="alert alert-danger mt-3">{{ session('fail') }}</div>
            @endif
            <form action="{{ route('loginPage.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control"  name="mobile_number" id="mobile_number" placeholder="" value="{{old('mobile_number')}}">
                    @error('mobile_number')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                    <label class="form-check-label" for="remember_me">Remember Me?</label>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </form>

            <p class="text-center mt-3">
                Don't have an account? <a href="{{ route('registerPage.view') }}" class="text-primary">Register here!</a>
            </p>
        </div>
    </div>
@endsection