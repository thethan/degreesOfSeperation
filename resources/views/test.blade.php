@extends('layouts.socket')

@section('content')
    <p id="power">0</p>
@stop

@section('footer')
    <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
    <script>
        //var socket = io('http://localhost:3000');
        var socket = io('http://imdb.app:3000');
        socket.on("test-channel:App\\Events\\DegreeSaved", function(message){
            // increase the power everytime we load test route
            console.log(message);
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        });
    </script>
@stop