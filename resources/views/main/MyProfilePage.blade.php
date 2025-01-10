@extends('layout.master')
@section('content')
{{-- Profile Section --}}
<div class="position-relative text-center overflow-hidden p-5">
    <div class="position-relative mx-auto" style="width: 8rem; height: 8rem;">
        <img src="{{ (Auth::user()->avatar) ? asset('images/avatar/' . Auth::user()->avatar) : asset('images/starterAvatar.jpg') }}" alt="Profile" class="img-fluid rounded-circle border-4 bg-white">
    </div>
    <p class="text-primary fw-semibold fs-3 mt-2">{{ Auth::user()->name }}</p>
    <p class="text-accent">@lang('message.joined') {{ Auth::user()->created_at->format('F Y') }}</p>
</div>

<div class="container mt-4 pb-5" style="max-width: 50rem;">
    {{-- Information Card --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <h2 class="fs-4 fw-bold">@lang('message.information')</h2>
            </div>
            <div class="">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <p class="mb-0">@lang('message.name')</p>
                    <p class="text-primary fw-medium mb-0">{{ Auth::user()->name }}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <p class="mb-0">Instagram</p>
                    <p class="text-primary fw-medium mb-0"><a href="{{ Auth::user()->instagram }}">{{ Auth::user()->instagram }}</a></p>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <p class="mb-0">@lang('message.hobbies')</p>
                    <div class="d-flex flex-column align-items-end">
                        @foreach (Auth::user()->hobbies as $item)
                        <p class="text-primary fw-medium mb-0">{{ $item->name }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <p class="mb-0">@lang('message.phone_number')</p>
                    <p class="text-primary fw-medium mb-0">{{ Auth::user()->mobile_number }}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <p class="mb-0">@lang('message.joined')</p>
                    <p class="text-primary fw-medium mb-0">{{ Auth::user()->created_at->format('d F Y') }}</p>
                </div>
                <div class="mt-4 d-flex flex-column gap-3">
                    <form action="{{ route('loginPage.logout') }}" method="GET" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-primary text-white w-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
