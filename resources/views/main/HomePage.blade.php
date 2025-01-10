@extends('layout.master')
@section('content')
    @if(Auth::check())
        <h1>@lang('message.welcome') {{Auth::user()->name}}</h1>
    @endif

    <form class="d-flex p-5" action="{{ route('homePage.search') }}" method="GET">
        @csrf
        <input class="form-control me-2" type="search" placeholder="@lang('message.search_placeholder')" aria-label="Search" name="search">
        <button class="btn btn-outline-primary" type="submit">@lang('message.search')</button>
        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
            @lang('message.gender')
            <svg class="w-5 h-5 text-neutral-light" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
            </svg>
        </a>
        <ul class="dropdown-menu">
            <li>
                <div class="dropdown-item" onclick="selectGender('Male')">
                    @lang('message.male')
                    <input type="checkbox" id="genderMale" name="gender" value="Male" style="display: none;">
                </div>
            </li>
            <li>
                <div class="dropdown-item" onclick="selectGender('Female')">
                    @lang('message.female')
                    <input type="checkbox" id="genderFemale" name="gender" value="Female" style="display: none;">
                </div>
            </li>
        </ul>
    </form>

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
            @foreach ($users as $user)
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
                        <form method="POST" action="{{ route('homePage.send', ['receiver_id' => $user->id]) }}">
                            @csrf
                            <button type="submit" style="background: none; border: none; padding: 0;">
                                <img src="{{ asset('images/ThumbIcon.png') }}" alt="" style="width: 30px">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        function selectGender(selectedValue) {
            const genderCheckboxes = document.querySelectorAll('input[name="gender"]');
            genderCheckboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });
    
            const selectedCheckbox = document.querySelector(`input[value="${selectedValue}"]`);
            if (selectedCheckbox) {
                selectedCheckbox.checked = true;
            }
        }
    </script>
    
@endsection