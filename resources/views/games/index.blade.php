@extends('layouts.app')


@section('content')
    <section class="container">
        <div class="row">
            <ol class="col-sm-8 col-sm-offset-2">
                @foreach($games as $game)
                    <li href="{{  url('/games', $game->id) }}">{{ $game->start }} to {{ $game->end }} </li>
                @endforeach
            </ol>
        </div>
        <div class="row col-sm-12">
            <h3 class="col-sm-3">New Game</h3>
            <form action="" class="col-sm-6" method="POST">
                {!! csrf_field() !!}
                <fieldset class="form-group">
                    <label for="formGroupExampleInput">Start</label>
                    <input type="text" class="form-control person typeahead" id="start" placeholder="">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput">End</label>
                    <input type="text" class="form-control person typeahead" id="end" placeholder="">
                </fieldset>
                <div>
                    <div>
                        <input type="hidden" name="start">
                        <input type="hidden" name="end">
                    </div>
                    <button id="submitNew" class="btn btn-primary-outline">
                        Submit
                    </button>
                </div>
            </form>
            <a href="{{ url('/games') }}"></a>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        var movies = new Bloodhound({

            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: 'search/movies/' + '%QUERY',
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
                url: 'search/people/' + '%QUERY',
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
            xhr.open('PUT', 'degrees/save', true);
            var params = datum;

            xhr.setRequestHeader("Content-Type", "application/json");
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

            var inputId = obj.target.id;
            var inputs = document.getElementsByName(inputId);
            inputs[0].value = datum.id;

            var xhr = new XMLHttpRequest();
            xhr.open('PUT', 'degrees/person/'+datum.id, true);
            var params = datum;

            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Content-type", "application/json");
            xhr.send(JSON.stringify(params));

            if (xhr.readyState == 4 && xhr.status == 200) {
                setDegreesOfSeperation(xhr.responseText);
            }

        });


    </script>
@endsection