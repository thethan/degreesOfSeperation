@extends('layouts.app')

@section('content')
    <div class="gameBoard">
        <div class="grid">
            @foreach($games as $game)
                <div class="grid-item item" id="game_{{$game->id}}" onclick="goToGame( {{ $game->id }})">
                    <img src="https://image.tmdb.org/t/p/w185/{{ $game->start_image }}" alt="">
                    <img src="https://image.tmdb.org/t/p/w185/{{ $game->end_image }}" alt="">
                </div>
            @endforeach

        </div>
    </div>

    {!! $games->links() !!}
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js"></script>

    <script>
        var grid = document.querySelector('.grid');
        var iso = new Isotope(grid, {
            // options...
            itemSelector: '.grid-item',
            masonry: {
                columnWidth: 200
            }
        });

        function goToGame( id) {
            element = document.getElementById('game_'+id);
            element.className = element.className + ' clicked';
            console.log(element);
            fadeOthers();

            setTimeout(function(){location.href="/degrees/play/"+id} , 3000);

        }

        function fadeOthers(){
            elements = document.querySelectorAll("div.grid-item:not(.clicked)");
            console.log(elements);
            for(var i = 0; i < elements.length; i++){
                elements[i].className =  elements[i].className + ' fade';
            }
        }



    </script>
@endsection


