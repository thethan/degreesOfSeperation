@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <style>
        .typeahead {
            position: absolute;
        }
    </style>
@endsection


@section('content')
    <section id="app" class="container-fluid">
        <div class="">
            <input id="authId" value="{{ Auth::user()->id }}" type="hidden">

            <div class="col-sm-12 row">
                <div class="col-sm-2">
                    <img src="https://image.tmdb.org/t/p/w185/{{ $game->start_image }}" alt="">
                </div>
                <div class="selection col-sm-6 col-sm-offset-1">

                    <div class="first" id="lastSelection">

                    </div>
                    <div>
                        <input class="movie typeahead col-sm-3 col-sm-offset-1" onkeyup="topResult()">
                        <input class="person typeahead col-sm-4 col-sm-offset-1" onkeyup="topResult()">
                        <div class="next" id="upcoming">

                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img class="pull-right" src="https://image.tmdb.org/t/p/w185/{{ $game->end_image }}" alt="">
                </div>
            </div>
            <div class="col-sm-12 ">
                <div id="degrees" class="degrees">
                    <div class="col-sm-12">

                    </div>
                </div>
                <div id="degrees-nav" class="row degrees-nav">
                    <div class="col-sm-12">

                    </div>
                </div>


            </div>


        </div>

        {{  csrf_field() }}


        <a id="validate" onclick="validate()" class="col-sm-2 btn btn-large btn-primary-outline" type="submit"
           value="submit">validate</a>

        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Created</th>
                <th>Finished</th>
                <th>Steps</th>
                <th>Correct</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Created</th>
                <th>Finished</th>
                <th>Steps</th>
                <th>Correct</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($results as $completedResult)
                <tr>
                    <td>{{ $completedResult->id }}</td>
                    <td>{{ $completedResult->user->name }}</td>
                    <td>{{ $completedResult->created_at }}</td>
                    <td>{{ $completedResult->updated_at }}</td>
                    <td>{{ $completedResult->steps }}</td>
                    @if($completedResult->correct == '1')
                        <td>Yes</td>
                        @else
                            <td>Not even close</td>
                        @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection



@section('scripts')
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
    <script>

        $('#example').DataTable({
            createdRow: function (row) {
                $('td', row).attr('tabindex', 0);
            }
        });

        function validate() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    obj = JSON.parse(xhttp.responseText);
                    console.log(obj);
                    degreesToHtml(obj.results);

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
                dosToDegrees(dos);
                nextDegree(dos);
            }
        };

        xhttp.open("GET", "/degrees/degrees/{{$game->id}}/{{ $result->id }}", true);
        xhttp.send();

        var url = window.location.hostname;
        var socket = io(url + ':3000');

        socket.on("user_" + {{ Auth::user()->id }} +"_game_{{ $game->id }}:App\\Events\\DegreeSaved", function (message) {
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
            var htmlOL = html = '<div  class="results">';
            for (var i = 0; i < dos.length; i++) {
                var active = '';
                if (i === (dos.length - 1)) {
                    var active = 'active';
                }
                '<div class="' + dos[i].class + ' "><div class="icon"></div><img class="' + dos[i].type + '" src="https://image.tmdb.org/t/p/w185/' + dos[i].poster_path + '" ></div>';
//            htmlOL += "<li data-target='#carousel-example-generic' data-slide-to='"+i+"' class='"+active+"'></li>";
//            htmlCarousel += '<div class="carousel-item '+dos[i].class+'"> <img data-src="https://image.tmdb.org/t/p/w185/'+dos[i].poster_path+'" alt="'+dos[i].title+'"> </div>';

                var lastHtml = '<div class="' + dos[i].class + ' "><div class="icon"></div><img class="' + dos[i].type + '" src="https://image.tmdb.org/t/p/w185/' + dos[i].poster_path + '" ></div>';
                html += lastHtml;
            }

            html += '</div>';
            document.getElementById('degrees').innerHTML = html;
            document.getElementById('lastSelection').innerHTML = lastHtml;

        }

        function validatedDegrees(dos) {

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
                url: '{{ route('search::movies', ['search'=>'']) }}/' + '%QUERY',
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
                url: '{{ route('search::people', ['search'=>'']) }}/' + '%QUERY',
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


        $('.typeahead').keyup(function (elem) {
            document.getElementById('upcoming').innerHTML = '';
            classes = elem.target.className;
            /*  baseClass = classes.replace(' typeahead col-sm-3 col-sm-offset-1 tt-input', '');
             if(baseClass === 'person') {
             suggestions = document.querySelectorAll('.tt-menu .tt-dataset-1');
             } else {
             suggestions = document.querySelectorAll('.tt-menu .tt-dataset-0');
             }

             var selection = document.getElementsByClassName('selection')[0];
             */
        });


        function topResult() {

        }
        // Instantiate the Typeahead UI
        $('.movie.typeahead').typeahead(null, {
            displayKey: 'title',
            limit: 10,
            source: movies.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'unable to find any movies with this title',
                    '</div>'
                ].join('\n'),
                suggestion: function (data) {
                    var html = '<div data-id="' + data.id + '" class="movie movie_' + data.id + '"><img src="https://image.tmdb.org/t/p/w185/' + data.poster_path + '"> <strong>' + data.title + '</strong></div>';
                    if ((document.getElementById('upcoming').innerHTML.trim() == "")) {
                        upcomingHtml(html);
                    }
                    return html;

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
            upcomingHtml('');
        });

        // Instantiate the Typeahead UI
        $('.person.typeahead').typeahead(null, {
            displayKey: 'name',
            limit: 10,
            source: people.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'unable to find any Best Picture winners that match the current query',
                    '</div>'
                ].join('\n'),
                suggestion: function (data) {

                    html = '<div data-id="' + data.id + '" class="person person_' + data.id + '"><img src="https://image.tmdb.org/t/p/w185/' + data.poster_path + '"> <strong>' + data.name + '</strong></div>';

                    if ((document.getElementById('upcoming').innerHTML.trim() == "")) {
                        upcomingHtml(html);
                    }

                    return html;

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
            upcomingHtml('');


        });

        function upcomingHtml(html) {
            document.getElementById('upcoming').innerHTML = html;
        }

        document.getElementsByClassName('tt-dataset')[0].addEventListener('change', firstImage);

        function firstImage() {
            document.getElementsByClassName('tt-dataset')[0]
        }

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