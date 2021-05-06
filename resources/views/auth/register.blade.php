@extends('layouts.auth')

@section('title') Sign Up @endsection

@section('content')
    <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
             alt="Workflow">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Register your devices
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or contact us to help you craft your device
            {{--            <a href="{{ route('signup') }}" class="font-medium text-indigo-600 hover:text-indigo-500">--}}
            {{--                --}}
            {{--            </a>--}}
        </p>
    </div>
    <form class="space-y-6 bg-white p-8 rounded" method="POST">
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div>
            <label for="email" class="">Email Address</label>
            <input id="email" name="email" type="email" autocomplete="email" required
                   class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                   value="{{ old('email') }}">
        </div>
        <div>
            <label for="username" class="">Username</label>
            <input id="username" name="username" type="text" required
                   class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                   value="{{ old('username') }}">
        </div>
        <div>
            <label for="name" class="">Name</label>
            <input id="name" name="name" type="text" required
                   class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                   value="{{ old('name') }}">
        </div>
        <div>
            <label for="password" class="">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
                   class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            >
        </div>
        <div>
            <label for="password_confirmation" class="">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   autocomplete="current-password" required
                   class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            >
        </div>

        <div class="flex items-center justify-between hidden">
            <div class="flex items-center">
                <input id="remember_me" name="remember_me" type="checkbox"
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                    Remember me
                </label>
            </div>

            <div class="text-sm">
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Forgot your password?
                </a>
            </div>
        </div>

        <div>
            <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <!-- Heroicon name: solid/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                    clip-rule="evenodd"/>
            </svg>
          </span>
                Sign up
            </button>
            @csrf
        </div>
    </form>
    <script>document.querySelector('#email').focus()</script>
@endsection
