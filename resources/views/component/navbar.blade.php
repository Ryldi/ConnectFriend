<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary border-bottom">
    <div class="container">
        <a class="navbar-brand text-primary d-flex align-items-center gap-3" href="{{ route('homePage.view') }}">
            <img src="{{ asset('images/logo.png') }}" alt="" width="30"> ConnectFriend</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse gap-4 d-flex justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav gap-4">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('homePage.view') }}">@lang('message.home')</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('friendRequestPage.view') }}">@lang('message.friend_request')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chatPage.view') }}">@lang('message.chat')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notificationPage.view') }}">@lang('message.notification')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('avatarPage.view') }}">Avatar</a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('message.language')
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('setLang', ['lang' => 'en']) }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('setLang', ['lang' => 'id']) }}">Indonesia</a></li>
                        {{-- <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    @if (Auth::check())
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"><img src="{{ (Auth::user()->avatar) ? asset('images/avatar/' . Auth::user()->avatar) : asset('images/starterAvatar.jpg') }}" alt="Profile" class="img-fluid rounded-circle border-4 bg-white" width="30"></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('myProfile.view') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('loginPage.logout') }}">Logout</a></li>
                        </ul>
                    @else
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                    @endif
                </li>
            </ul>
            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>