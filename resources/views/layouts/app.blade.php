<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
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
<body class="h-100">
    <div id="app" class="d-flex flex-column h-100">
        <header>
            @if (request()->route()->named('admin.*'))
                @include('layouts.navbar.admin')
            @else
                @include('layouts.navbar.app')
            @endif
        </header>

        <main class="py-4 flex-shrink-0">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="footer bg-dark text-muted mt-auto py-3">
            <div class="container">
                <div class="row justify-content-center">
                    {{ config('app.name', 'Laravel') }} © {{ date('Y') }} All right reserved
                </div>
            </div>
        </footer>
    </div>

</body>
</html>
