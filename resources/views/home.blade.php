@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="jumbotron">
                    <h1 class="display-3">Degrees of Seperation</h1>
                    <p class="lead">Select a game or play a game.</p>
                    <hr class="m-y-2">
                    <p>If you feel so inclined you can go ahead and create games.</p>
                    <p class="lead">
                        <a class="btn btn-warning btn-lg" href="/games" role="button">Create</a>
                        <a class="btn btn-success btn-lg pull-right" href="/play" role="button">Play</a>

                    </p>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <a class="btn btn-lg btn-success-outline" href="/play">play</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
