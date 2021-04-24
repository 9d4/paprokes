<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/tabler.min.css') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
</head>
<body>
@include('partials.navigation')
<div class="container-xl my-3" style="display: grid; place-items: center; height: 68vh">
    {{--<div class="row">--}}
    {{--    <div class="col">--}}
    @yield('content')
    {{--    </div>--}}
    {{--</div>--}}
</div>
@include('partials.scripts')
</body>
</html>