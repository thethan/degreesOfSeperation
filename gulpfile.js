var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        //'../../../bower_components/tether/dist/css/*',
        'app.scss',
        '../../../bower_components/bootstrap/scss/bootstrap-flex.scss',
        '../../../bower_components/typeahead.js/dist/typeahead.bundle.css',

    ]);

    mix.scripts(
        [
            '../../../bower_components/jquery/dist/jquery.js',
            '../../../bower_components/tether/dist/js/tether.js',
            '../../../bower_components/bootstrap/dist/js/bootstrap.js',
            '../../../bower_components/typeahead.js/dist/typeahead.bundle.js',
            'app.js'
        ])
        .version(['js/all.js', 'css/app.css'])
    .browserSync({
        proxy: 'imdb.app'
    });
});
