<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('v2-assets/css/app.css') }}">
</head>
<body>
    @yield('content')
<script src="{{ asset('v2-assets/js/app.js') }}"></script>
</body>
</html>