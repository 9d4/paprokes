@extends('layouts.auth')

@section('title') Login @endsection

@section('content')
    <form method="post" style="width: 100%;max-width: 360px;">
        <div class="mb-3">
            <h1 class="display-6 mb-1">Login</h1>
            <small class="text-muted">Login to gain access to the system</small>
        </div>
        <div class="mb-2">
            <input class="form-control" type="text" name="username" placeholder="Username" id="login_username">
        </div>
        <div class="mb-2">
            <input class="form-control" type="password" name="password" placeholder="Kata Sandi">
        </div>
        @csrf
        <div class="text-end">
            <button type="submit" class="btn btn-azure">Masuk</button>
        </div>
    </form>
    <script>
        document.querySelector('#login_username').focus()
    </script>
@endsection