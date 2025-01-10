@extends('layout.master')
@section('content')
    <h1>@lang('message.chat')</h1>
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
            @if (!$friends->isEmpty())
                @foreach ($friends as $user)
                <a href="">
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>
                            @foreach ($user->hobbies as $hobby)
                                {{$hobby->name}};
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('profilePage.view', ['user_id' => $user->id]) }}"><img src="{{ ($user->avatar == null) ? asset('images/starterAvatar.jpg') : asset('images/avatar/' . $user->avatar)  }}" alt="" class="rounded-circle" width="30"></a>
                        </td>
                        <td>
                            <a href="{{ route('chatDetailPage.view', ['receiver_id' => $user->id]) }}">@lang('message.chat')</a>
                        </td>
                    </tr>
                </a>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center"> You have no friend to chat!</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection