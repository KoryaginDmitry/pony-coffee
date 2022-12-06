<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <title>@yield('title')</title>

    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>
<body>
    @yield('content')
</body>
</html>