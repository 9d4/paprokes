<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? $attributes['title'] ?? config('app.name') }}</title>
    @auth
        <link rel="stylesheet" href="{{ asset('v2-assets/css/admin.css') }}">
    @elseguest
        <link rel="stylesheet" href="{{ asset('v2-assets/css/tw.css') }}">
    @endauth
    <script>
        let app = {!! json_encode(['csrf' => csrf_token()]) !!}
    </script>
</head>
@auth
    <body class="layout-fixed layout-navbar-fixed dark-mode">
    <main class="wrapper">
        <x-dash.navigation/>
        <x-dash.sidebar/>
        <div class="content-wrapper">
            <div class="container-lg px-4 {{ $attributes['class'] }}">
                <div class="mb-3">
                    <x-dash.title>{{ $pageTitle ?? $attributes['page-title']}}</x-dash.title>
                    @if (!!$attributes['page-subtitle'])
                        <x-dash.subtitle>{{ $attributes['page-subtitle'] }}</x-dash.subtitle>
                    @endif
                </div>
                <hr/>
                {{ $slot }}
            </div>
        </div>
    </main>
    <div id="dialogContainer"></div>
    <div id="dialogBackdrop" class="fade"></div>
    <script src="{{ asset('v2-assets/js/admin.js') }}" defer></script>
    </body>
@elseguest
    <body>
    <div class="h-screen bg-gray-600">
        <div class="sm:h-full grid p-3 sm:place-items-center sm:content-center">
            <h1 class="text-3xl sm:text-6xl md:text-8xl font-light text-indigo-50 border-b-4 border-indigo-50 pb-2">{{ config('app.name') }}</h1>
            <p class="text-white"><b>Pa</b>tuhi <b>Pro</b>tokol <b>Kes</b>ehatan</p>
            <div class="flex flex-row-reverse sm:flex-row mt-2 content-between">
                <a role="button" href="{{ route('signup') }}"
                   class="m-2 border-2 py-1 px-7 sm:py-2 border-transparent focus:bg-yellow-400 hover:bg-yellow-400 focus:border-yellow-600 text-center rounded bg-yellow-500 text-white">Register
                    Device</a>
                <a role="button" href="{{ route('login') }}"
                   class="m-2 border-2 py-1 px-7 sm:py-2 border-transparent focus:bg-blue-400 hover:bg-blue-400 focus:border-blue-600 text-center rounded bg-blue-500 text-white">Login</a>
            </div>
        </div>
    </div>
    </body>
@endauth
</html>