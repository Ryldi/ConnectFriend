<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ConnectFriend</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body style="min-height: 100vh; display: flex; flex-direction: column;">
    @include('component.navbar')
    @include('component.toast')
    <div class="container my-3" style="flex-grow: 1;">
        @yield('content')
    </div>
    @include('component.footer')
</body>
</html>