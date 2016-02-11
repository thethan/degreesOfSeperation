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

        /*html {*/
            /*overflow-y: scroll;*/
        /*}*/

        /*.container {*/
            /*margin: 0 auto;*/
            /*max-width: 750px;*/
            /*text-align: center;*/
        /*}*/

        /*.tt-dropdown-menu, .gist {*/
            /*text-align: left;*/
        /*}*/

        /*html {*/
            /*color: #333333;*/
            /*font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;*/
            /*font-size: 18px;*/
            /*line-height: 1.2;*/
        /*}*/

        /*.title, .example-name {*/
            /*font-family: Prociono;*/
        /*}*/

        /*p {*/
            /*margin: 0 0 10px;*/
        /*}*/

        /*.title {*/
            /*font-size: 64px;*/
            /*margin: 20px 0 0;*/
        /*}*/

        /*.example {*/
            /*padding: 30px 0;*/
        /*}*/

        /*.example-name {*/
            /*font-size: 32px;*/
            /*margin: 20px 0;*/
        /*}*/

        /*.demo {*/
            /*margin: 50px 0;*/
            /*position: relative;*/
        /*}*/

        /*.typeahead, .tt-query, .tt-hint {*/
            /*border: 2px solid #CCCCCC;*/
            /*border-radius: 8px 8px 8px 8px;*/
            /*font-size: 24px;*/
            /*height: 30px;*/
            /*line-height: 30px;*/
            /*outline: medium none;*/
            /*padding: 8px 12px;*/
            /*width: 396px;*/
        /*}*/

        /*.typeahead {*/
            /*background-color: #FFFFFF;*/
        /*}*/

        /*.typeahead:focus {*/
            /*border: 2px solid #0097CF;*/
        /*}*/

        /*.tt-query {*/
            /*box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;*/
        /*}*/

        /*.tt-hint {*/
            /*color: #999999;*/
        /*}*/

        /*.tt-dropdown-menu {*/
            /*background-color: #FFFFFF;*/
            /*border: 1px solid rgba(0, 0, 0, 0.2);*/
            /*border-radius: 8px 8px 8px 8px;*/
            /*box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);*/
            /*margin-top: 12px;*/
            /*padding: 8px 0;*/
            /*width: 422px;*/
        /*}*/

        /*.tt-suggestion {*/
            /*font-size: 18px;*/
            /*line-height: 24px;*/
            /*padding: 3px 20px;*/
        /*}*/

        /*.tt-suggestion.tt-cursor {*/
            /*background-color: #0097CF;*/
            /*color: #FFFFFF;*/
        /*}*/

        /*.tt-suggestion p {*/
            /*margin: 0;*/
        /*}*/

        /*.gist {*/
            /*font-size: 14px;*/
        /*}*/

        /*.example-twitter-oss .tt-suggestion {*/
            /*padding: 8px 20px;*/
        /*}*/

        /*.example-twitter-oss .tt-suggestion + .tt-suggestion {*/
            /*border-top: 1px solid #CCCCCC;*/
        /*}*/

        /*.example-twitter-oss .repo-language {*/
            /*float: right;*/
            /*font-style: italic;*/
        /*}*/

        /*.example-twitter-oss .repo-name {*/
            /*font-weight: bold;*/
        /*}*/

        /*.example-twitter-oss .repo-description {*/
            /*font-size: 14px;*/
        /*}*/

        /*.example-sports .league-name {*/
            /*border-bottom: 1px solid #CCCCCC;*/
            /*margin: 0 20px 5px;*/
            /*padding: 3px 0;*/
        /*}*/

        /*.example-arabic .tt-dropdown-menu {*/
            /*text-align: right;*/
        /*}*/
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

                <li class="nav-item"><a class="nav-link" href="/degrees/games">Degrees</a></li>
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
