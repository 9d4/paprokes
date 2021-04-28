<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} - Realtime History</title>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster'),
        ]) !!}
    </script>
    <link rel="stylesheet" href="{{ asset('css/beta/realtime/app.css') }}">
</head>
<body>
<div class="container" id="app">
    <h4 class="bg-warning p-2 mb-2">Realtime Record <span class="badge bg-primary">Beta</span></h4>
    <small>The last 50 records</small>
    @yield('content')
</div>
<script src="{{ asset('js/beta/realtime/app.js') }}"></script>
<script src="{{ asset('js/beta/realtime/view.js') }}"></script>
</body>
</html>