<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @if (request()->route()->named('admin.*'))
            @include('layouts.navbar.admin')
        @else
            @include('layouts.navbar.app')
        @endif

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="bg-dark text-muted py-3">
            <div class="container">
                <div class="row justify-content-center">
                    {{ config('app.name', 'Laravel') }} © {{ date('Y') }} All right reserved
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
