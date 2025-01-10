@extends('layout.master')
@section('content')
    @if (session('accept'))
        <div class="alert alert-success mt-3">{{ session('accept') }}</div>
    @elseif (session('cancel'))
        <div class="alert alert-warning mt-3">{{ session('cancel') }}</div>
    @endif

    <h3>@lang('message.sent request')</h3>
    <table class="table">
        <thead>
            <tr>
                <th>@lang('message.name')</th>
                <th>@lang('message.hobbies')</th>
                <th>@lang('message.photo')</th>
                <th>@lang('message.action')</th>
            </tr>
        </thead>
        <tbody>
            @if (!$sent->isEmpty())
                @foreach ($sent as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>
                            {{ $user->hobbies->pluck('name')->join(', ') }}
                        </td>
                        <td>
                            <a href="{{ route('profilePage.view', ['user_id' => $user->id]) }}">
                                <img src="{{ ($user->avatar == null) ? asset('images/starterAvatar.jpg') : asset('images/avatar/' . $user->avatar) }}" alt="" class="rounded-circle" width="30">
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('friendRequestPage.unsend', ['receiver_id' => $user->id]) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="background: none; border: none; padding: 0;">
                                    <img src="{{ asset('images/ThumbDownIcon.png') }}" alt="" style="width: 30px">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center"> No sent friend request yet!</td>
                </tr>
            @endif
        </tbody>
    </table>
    
    <h3>@lang('message.received request')</h3>
    <table class="table">
        <thead>
            <tr>
                <th>@lang('message.name')</th>
                <th>@lang('message.hobbies')</th>
                <th>@lang('message.photo')</th>
                <th>@lang('message.action')</th>
            </tr>
        </thead>
        <tbody>
            @if (!$received->isEmpty())
                @foreach ($received as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>
                            @foreach ($user->hobbies as $hobby)
                                {{$hobby->name}};
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('profilePage.view', ['user_id' => $user->id]) }}"><img src="{{ ($user->avatar == null) ? asset('images/starterAvatar.jpg') : asset('images/avatar/' . $user->avatar) }}" alt="" class="rounded-circle" width="30"></a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('friendRequestPage.accept', ['sender_id' => $user->id]) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="background: none; border: none; padding: 0;">
                                    <img src="{{ asset('images/ThumbIcon.png') }}" alt="" style="width: 30px">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center"> No received friend request yet!</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection