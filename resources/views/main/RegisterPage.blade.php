@extends('layout.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 500px; border-radius: 10px;">
            <h1 class="text-center">Register</h1>
            <form action="{{ route('registerPage.register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} >
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" {{ old('gender') == 'Female' ? 'checked' : ''}}>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    @error('gender')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control"  name="instagram" id="instagram" placeholder="https://www.instagram.com/username" value="{{old('instagram')}}">
                    @error('instagram')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control"  name="mobile_number" id="mobile_number" placeholder="" value="{{old('mobile_number')}}">
                    @error('mobile_number')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob" placeholder="" value="{{old('dob')}}">
                    @error('dob')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hobby" class="form-label">Hobbies <small>(min. 3)</small></label>
                    <div style="height: 200px; overflow-y: scroll">
                        @foreach ($hobbies as $hobby)
                        <div>
                            <input type="checkbox" name="hobby[]" id="hobby{{$hobby->id}}" value="{{$hobby->id}}"  {{ in_array($hobby->id, old('hobby', [])) ? 'checked' : '' }}>
                            <label for="hobby{{$hobby->id}}">{{$hobby->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    @error('hobby')
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

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    @error('password_confirmation')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
            </form>

            <p class="text-center mt-3">
                Already have an account? <a href="{{ route('login') }}" class="text-primary">Login here!</a>
            </p>
        </div>
    </div>
@endsection