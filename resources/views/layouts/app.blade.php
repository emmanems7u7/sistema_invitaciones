<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Mensajes de éxito -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Mensajes de error de validación -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="validationAlert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <script>
                // Añadir animación de entrada (slide-down)
                document.addEventListener('DOMContentLoaded', function () {
                    // Mensajes de éxito
                    const successAlert = document.getElementById('successAlert');
                    if (successAlert) {
                        successAlert.classList.add('slide-in');

                        // Animación para desaparecer (fade-out) después de 5 segundos
                        setTimeout(function () {
                            successAlert.classList.remove('slide-in');
                            successAlert.classList.add('fade-out');
                        }, 5000);
                    }

                    // Mensajes de error
                    const validationAlert = document.getElementById('validationAlert');
                    if (validationAlert) {
                        validationAlert.classList.add('slide-in');

                        // Animación para desaparecer (fade-out) después de 5 segundos
                        setTimeout(function () {
                            validationAlert.classList.remove('slide-in');
                            validationAlert.classList.add('fade-out');
                        }, 5000);
                    }
                });
            </script>

            <style>
                /* Animación de deslizamiento desde arriba */
                .slide-in {
                    animation: slideIn 1s ease-out;
                }

                @keyframes slideIn {
                    from {
                        transform: translateY(-100%);
                        opacity: 0;
                    }

                    to {
                        transform: translateY(0);
                        opacity: 1;
                    }
                }

                /* Animación de desvanecimiento */
                .fade-out {
                    animation: fadeOut 1s forwards;
                }

                @keyframes fadeOut {
                    from {
                        opacity: 1;
                    }

                    to {
                        opacity: 0;
                    }
                }
            </style>


            @yield('content')
        </main>
    </div>
</body>

</html>