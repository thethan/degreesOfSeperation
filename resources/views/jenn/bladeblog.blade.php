@extends('jenn.layout')

@section('styles')
    <style>

    </style>
    <link rel="stylesheet" href="{{ elixir('css/jenn.css') }}">

@endsection


@section('scripts')
@endsection

@section('content')
    <div class="blog">
        <div class="collapse" id="exCollapsingNavbar">
            <div class="bg-inverse p-a-1">
                <h4>Jenn McHugh</h4>
                <ul class="text-muted column">
                    <li><a href="/jenn/blog" class="delayClick">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            &#9776;
        </button>
        <header class="row">
            <h6 class="fadeIn fadeUp">JMQ</h6>
           {{-- <div class="stripes">
                <div class="transStart stripe"></div>
                <div class="transStart stripe second"></div>
                <div class="transStart stripe"></div>

            </div>--}}
        </header>
    </div>
@endsection