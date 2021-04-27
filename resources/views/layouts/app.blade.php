<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel api de juegos</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style=" background-color: #000; font-family: 'Fira Sans', sans-serif;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #252525;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 1.125rem; font-family: 'Nunito', sans-serif; font-weight: 400; color: white;">Laravel Api Juegos</a>
                <button class="navbar-toggler" type="button" style="border: 1px solid white;" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if ((Cookie::get('token') == null && !isset($token)) || isset($logout))
                        <li class="nav-item">
                            <a class="nav-link" style="color: white; font-family: 'Nunito', sans-serif; font-size: 0.9rem; font-weight: 400; color: white;" href="{{ route('login') }}">{{ __('Iniciar sessión') }}</a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                        @if ((Cookie::get('token') !== null || isset($token)) && !isset($logout))
                            <a id="navbarDropdown" class="nav-link" style="color: white; font-family: 'Nunito', sans-serif; font-size: 0.9rem; font-weight: 400; color: white;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" v-pre>
                                {{ __('Cerrar sessión') }} <span class="caret"></span>
                            </a>

                            <form id="logout-form" action="{{ url("auth/logout") }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: white; font-family: 'Nunito', sans-serif; font-size: 0.9rem; font-weight: 400; color: white;" href="https://github.com/JAVI-CC/Laravel-API-Client" target="_blank">Más información</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>