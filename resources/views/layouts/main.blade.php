<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Keep track of domains and respective clients.">
        <meta name="author" content="Freddy Duarte">

        <title>Domain Manager @yield('title')</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/css/app.css" />

    </head>

    <body>

    <div class="container">
        <nav class="navbar navbar-expand-lg" style="">
            <a class="navbar-brand" href="#"><img src="{{ asset('img/logo.png') }}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="/">Domains</a>
                    <a class="nav-item nav-link" href="/clients">Clients</a>
                    <a class="nav-item nav-link" href="/services">Services</a>
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a class="nav-item nav-link" href="{{ url('/home') }}">Home</a>
                            @else
                                <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a class="nav-item nav-link" href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <div id="loader"></div>

        <div class="row mt-5">
            <div class="col-12 mb-5">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Display errors --}}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <h3>Please correct the following issues:</h3>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <div class="flex-center position-ref full-height">
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    </body>

</html>
