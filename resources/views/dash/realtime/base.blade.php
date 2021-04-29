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
    <link rel="stylesheet" href="{{ asset('beta/realtime/app.css') }}">
</head>
<body>
<div id="app">
    <div class="bg-warning p-2 mb-2 d-flex justify-content-between align-items-center">
        <h4>Realtime Record <span class="badge bg-primary">Beta</span></h4>
        <span class="h5">@{{ time }} - @{{ year }}</span>
    </div>
    <div class="container-lg">
        <small>Only the last @{{ records.length }} records will be shown on the table.</small>
        @yield('content')
    </div>
</div>
<script src="{{ asset('beta/realtime/app.js') }}"></script>
</body>
</html>