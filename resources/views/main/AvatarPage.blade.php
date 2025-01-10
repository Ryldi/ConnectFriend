@extends('layout.master')

@section('content')
<div class="container d-flex justify-content-around">
    <div class="d-flex flex-column gap-5 align-items-center">
        <div class="d-flex flex-column gap-5">
            <img src="{{ (Auth::user()->avatar) ? asset('images/avatar/' . Auth::user()->avatar) : asset('images/starterAvatar.jpg') }}" alt="Profile" class="img-fluid rounded-circle border-4 bg-white" width="200">
            <div class="p-2 border rounded rounded-5 d-flex gap-2" style="max-width: 300px; overflow-x: scroll">
                @if (count($user_avatars) > 0)
                @foreach ($user_avatars as $item)
                    <div class="d-flex flex-column border rounded rounded-5 p-2 align-items-center">
                        <img src="{{ asset('images/avatar/' .$item->url) }}" alt="" class="img-fluid rounded-5" width="50">
                        <form action="{{ route('avatarPage.use', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary text-white w-100 mt-2">Use</button>
                        </form>
                    </div>
                @endforeach
                @else
                    <div class="d-flex flex-column border rounded rounded-5 p-2 align-items-center">
                        There is not avatar yet
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex gap-5 align-items-center">
            <div class="fw-bold fs-3">My Coins: </div>
            <div class="fw-semibold fs-5 text-primary">{{ Auth::user()->coins }}</div>
        </div>
        <div class="">
            <form action="{{ route('topUp') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary text-white w-100">
                    Topup
                </button>
            </form>
        </div>
    </div>
    <div class="p-5 border rounded rounded-5" style="min-width: 500px; max-width: 500px">
        <h2>Avatar</h2>
        <div class="d-flex justify-content-evenly gap-5">
            @if (count($avatars) > 0)
                @foreach ($avatars as $item)
                    <div class="d-flex flex-column border rounded rounded-5 p-2 align-items-center">
                        <img src="{{ asset('images/avatar/' .$item->url) }}" alt="" class="img-fluid rounded-5" width="50">
                        <p class="text-secondary fw-light fs-6 mt-2">{{ $item->price }} coins</p>
                        <form action="{{ route('avatarPage.buy', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary text-white w-100 mt-2">Buy</button>
                        </form>
                    </div>
                @endforeach
            @else
                
            @endif
        </div>
    </div>
</div>
@endsection