@extends('jenn.layout')

@section('styles')
    <style>

    </style>

    <link rel="stylesheet" href="{{ elixir('css/jenn.css') }}">

@endsection


@section('scripts')
    <script src="{{ elixir('js/jenn.js') }}"></script>
@endsection


@section('content')
        <div class="collapse" id="exCollapsingNavbar">
            <div class="bg-inverse p-a-1">
                <h4>Jenn McHugh</h4>
                <ul class="text-muted column">
                    <li><a href="/jenn/header" class="delayClick">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            &#9776;
        </button>
        <header class="row">
            <h1 class="fadeIn">JMQ</h1>
            <p class="fadeIn"><a href="mailto:jmq@jennmchugh.com?Subject=FrontPage%20email">email@jennmchugh.com</a></p>
            <div class="stripes">
                <div class="transStart stripe"></div>
                <div class="transStart stripe second"></div>
                <div class="transStart stripe"></div>

            </div>
        </header>
    </div>
@endsection