<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('v2-assets/css/app.css') }}">
</head>
<body class="h-full font-sans bg-gray-700 select-none">
@auth

@elseguest
    <div class="sm:h-full grid p-3 sm:place-items-center sm:content-center">
        <h1 class="text-3xl sm:text-6xl md:text-8xl font-light text-indigo-50 border-b-4 border-indigo-50 pb-2">{{ config('app.name') }}</h1>
        <p class="text-white"><b>Pa</b>tuhi <b>Pro</b>tokol <b>Kes</b>ehatan</p>
        <div class="flex flex-row-reverse sm:flex-row mt-2 content-between">
            <a role="button" href="{{ route('signup') }}" class="m-2 border-2 py-1 px-7 sm:py-2 border-transparent focus:bg-yellow-400 hover:bg-yellow-400 focus:border-yellow-600 text-center rounded bg-yellow-500 text-white">Register Device</a>
            <a role="button" href="{{ route('login') }}" class="m-2 border-2 py-1 px-7 sm:py-2 border-transparent focus:bg-blue-400 hover:bg-blue-400 focus:border-blue-600 text-center rounded bg-blue-500 text-white">Login</a>
        </div>
    </div>
@endauth
</body>
</html>
