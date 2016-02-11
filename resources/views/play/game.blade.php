@extends('layouts.app')


@section('content')
    <section id="app" class="container-fluid">
        <div class="row">
            <input id="authId" value="{{ Auth::user()->id }}" type="hidden">
            <div class="col-sm-12 row">
                <div class="col-sm-6">
                    <img src="https://image.tmdb.org/t/p/w185/{{ $game->start_image }}" alt="">
                </div>
                <div class="col-sm-6">
                    <img class="pull-right" src="https://image.tmdb.org/t/p/w185/{{ $game->end_image }}" alt="">
                </div>
            </div>
            <div class="col-sm-10 col-sm-offset-1">
                <div id="degrees" class="row">
                    <div class="col-sm-12">

                    </div>
                </div>


            </div>
        </div>

        {{  csrf_field() }}
        <input class="movie typeahead col-sm-3 col-sm-offset-1">
        <input class="person typeahead col-sm-4 col-sm-offset-1">


        <a id="validate" onclick="validate()" class="col-sm-2 btn btn-large btn-primary-outline" type="submit" value="submit">validate</a>
    </section>
@endsection


@section('scripts')
    <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
    <script>

        function validate(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    dos = JSON.parse(xhttp.responseText);
                    console.log(dos);
                    validatedDegrees(dos);

                }
            };
            xhttp.open("POST", "/degrees/play/validate/{{ $result->id }}", true);
            xhttp.setRequestHeader("Content-type", "application/json");

            xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            xhttp.send();
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                dos = JSON.parse(xhttp.responseText);
                console.log(dos);
                dosToDegrees(dos);
                nextDegree(dos);
            }
        };

        xhttp.open("GET", "/degrees/degrees/{{$game->id}}/{{ $result->id }}", true);
        xhttp.send();

        var url = window.location.host;
        var socket = io('http://' + url + ':3002');

        socket.on("user_" + {{ Auth::user()->id }} +"_game_{{ $game->id }}:App\\Events\\DegreeSaved", function (message) {
            // increase the power everytime we load test route
//            $('#degrees').text(parseInt($('#degrees').text()) + parseInt(message.data.power));
            addDegrees(message);

        });

        function addDegrees(message) {
            degreesToHtml(message.data.dos);
            nextDegree(message.data.dos);
        }
        function degreesToHtml(dos) {

            dosToDegrees(dos);
        }

        function dosToDegrees(dos) {

            var html = '';
            for (var i = 0; i < dos.length; i++) {
                html += '<div class="'+  dos[i].class +' "><img class="' + dos[i].type + '" src="https://image.tmdb.org/t/p/w185/' + dos[i].poster_path + '" ></div>';
            }
            document.getElementById('degrees').innerHTML = html;
        }

        function validatedDegrees(dos) {
            var html = '';
            for (var i = 0; i < dos.length; i++) {
                html += '<div class="'+ dos[i].type +'"><img class="' + dos[i].type  +'" src="https://image.tmdb.org/t/p/w185/' + dos[i].poster_path + '" ></div>';
            }
            document.getElementById('degrees').innerHTML = html;
        }

        function nextDegree(dos) {
            switch (dos[dos.length - 1].type) {
                case 'person':
                    showNext('movie');
                    break;
                case 'movie':
                    showNext('person');
                    break;
            }
        }

        function showNext(type) {
            $('.typeahead').hide();
            $('.' + type + '.typeahead').show().val('');
        }

        function checklast(dos) {
            last = dos.length - 1;


        }
    </script>
    <script>
        var movies = new Bloodhound({

            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '/degrees/search/movies/' + '%QUERY',
                filter: function (obj) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(obj.results, function (result) {
                        return {
                            title: result.original_title,
                            poster_path: result.poster_path,
                            id: result.id,
                            type: 'movie'
                        };
                    });
                }
            }
        });


        var people = new Bloodhound({

            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '/search/people/' + '%QUERY',
                filter: function (obj) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(obj.results, function (result) {
                        return {
                            name: result.name,
                            poster_path: result.profile_path,
                            id: result.id,
                            type: result.actor
                        };
                    });
                }
            }
        });


        // Initialize the Bloodhound suggestion engine
        movies.initialize();

        people.initialize();


        // Instantiate the Typeahead UI
        $('.movie.typeahead').typeahead(null, {
            displayKey: 'title',
            source: movies.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'unable to find any Best Picture winners that match the current query',
                    '</div>'
                ].join('\n'),
                suggestion: function (data) {
                    return '<div class="movie_' + data.id + '"><img src="https://image.tmdb.org/t/p/w185/' + data.poster_path + '"> <strong>' + data.title + '</strong></div>';

                }
            }
        }).on('typeahead:selected', function (obj, datum) {
            datum._token = '{{ csrf_token() }}';
            datum.type = 'movie';
            var xhr = new XMLHttpRequest()
            var self = this
            xhr.open('PUT', '/degrees/degrees/save/{{$result->id}}', true);
            var params = datum;

            xhr.setRequestHeader("Content-type", "application/json");
            xhr.send(JSON.stringify(params));

            if (xhr.readyState == 4 && xhr.status == 200) {
                setDegreesOfSeperation(xhr.responseText);
            }
        });

        // Instantiate the Typeahead UI
        $('.person.typeahead').typeahead(null, {
            displayKey: 'name',
            source: people.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'unable to find any Best Picture winners that match the current query',
                    '</div>'
                ].join('\n'),
                suggestion: function (data) {
                    return '<div class="person_' + data.id + '"><img src="https://image.tmdb.org/t/p/w185/' + data.poster_path + '"> <strong>' + data.name + '</strong></div>';

                }
            }
        }).on('typeahead:selected', function (obj, datum) {
            datum._token = '{{ csrf_token() }}';
            datum.type = 'person';
            var xhr = new XMLHttpRequest()
            var self = this
            xhr.open('PUT', '/degrees/degrees/save/{{$result->id}}', true);
            var params = datum;

            xhr.setRequestHeader("Content-Type", "application/json");
            if (xhr.status == 200) {
            }
            xhr.send(JSON.stringify(params));


        });

        function setDegreesOfSeperation(obj) {
            var degreesElement = document.getElementById('degrees');
            html = "";
            for (var i = 0; i < obj.length; i++) {
                var data = obj[i];
                html += '<div class="' + data.type + '"><img src="https://image.tmdb.org/t/p/w185/' + data.poster_path + '"></div>';
            }
            degreesElement.innerHTML = html;
        }

    </script>
@endsection