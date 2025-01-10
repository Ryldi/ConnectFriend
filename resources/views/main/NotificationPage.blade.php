@extends('layout.master')
@section('content')
    {{-- @foreach ($notifications as $notification)
        <ul>
            <li>
                {{$notification->message}}
                {{$notification->created_at}}
            </li>
        </ul>
    @endforeach --}}
    <div class="container mt-5">
        <h2>@lang('message.notifications')</h2>
        @foreach ($notifications as $notification)
            <div class="alert alert-info d-flex justify-content-between align-items-center mb-3">
                <div>
                    <strong>{{ $notification->message }}</strong>
                </div>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
@endsection