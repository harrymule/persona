<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <style>
        @media (min-width: 1024px) {
            .lg\:h-screen {
                height: 75vh;
            }
        }
    </style>
    <div id="app">

        <nav class="mx-auto flex justify-between items-center px-24 py-6 text-2xl align-middle bg-white">
            <div class="w-1/3 flex justify-start">
                <a href="{{ url('/') }}" class="font-bold">{{ config('app.name', 'Persona') }}</a>
            </div>


            @auth
            <div class="w-2/3 flex justify-end">
                <div class="relative inline-block text-left">
                    <a href="{{ route('logout') }}" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>{{ __('Logout') }}</span>
                        {{-- {{ Auth::user()->name }} --}}

                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>

            </div>


            @endauth


        </nav>

        <main class="bg-gray-100">
            <router-view></router-view>
            @yield('content')
        </main>






    </div>

</body>

</html>
