<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SelfTotten.com</title>

    <!-- Fonts -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/typeaheadjs.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    <style>

        #custom-templates .empty-message {
            padding: 5px 10px;
            text-align: center;
        }

        @font-face {
            font-family: "Prociono";
            /*src: url("../font/Prociono-Regular-webfont.ttf");*/
        }

    </style>
    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

    <style>
        .wrong {

            background: rgba(204,0,0,1);
        }
        .wrong img {
            opacity: .6;
        }
        .wtf img {
            -ms-transform: rotate(180deg); /* IE 9 */
            -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
            transform: rotate(180deg);
        }
        .correct{
            background: rgba(0,204,0,1);
        }
        .correct img {
            opacity: .6;
        }
    </style>

    @yield('styles')
</head>
<body id="app-layout">

    <nav class="navbar navbar-light navbar-nav bg-faded">
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
            &#9776;
        </button>
        <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
            <a class="navbar-brand" href="#">SelfTotten.com</a>
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item"><a class="nav-link" href="{{ route('play::index') }}">Play</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right nav-item pull-xs-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a href="{{ url('/login') }}">Login</a></li>
                    <li class="nav-item"><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class=" nav-link dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"  role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu2">
                            <li class="dropdown-item"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.js"></script>

    <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
    <script></script>
    <script src="{{ elixir('js/all.js') }}"></script>

    @yield('scripts')

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
