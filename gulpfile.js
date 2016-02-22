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

elixir(function (mix) {
    mix.sass([
        //'../../../bower_components/tether/dist/css/*',
        'fa/font-awesome.scss',
        'app.scss',
        'redactor/redactor.css',
        '../../../bower_components/typeahead.js/dist/typeahead.bundle.css'

    ]);
    mix.sass(['jenn.scss'], 'public/css/jenn.css');
    mix.sass(['jenn2.scss'], 'public/css/jenn2.css');

    mix.sass(['../../../bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'], 'public/css/datepicker.css');

    mix.scripts(
        [
            '../../../bower_components/jquery/dist/jquery.js',
            '../../../bower_components/tether/dist/js/tether.js',
            '../../../bower_components/bootstrap/dist/js/bootstrap.js',
            '../../../bower_components/typeahead.js/dist/typeahead.bundle.js',
            'redactor/redactor.js',
            'app.js'
        ]).scripts([
            '../../../bower_components/jquery/dist/jquery.js',
            '../../../bower_components/tether/dist/js/tether.js',
            '../../../bower_components/bootstrap/dist/js/bootstrap.js',
            'jenn.js']
        , 'public/js/jenn.js')
        .scripts([
            '../../../bower_components/jquery/dist/jquery.js',
            '../../../bower_components/moment/min/moment.min.js',
            '../../../bower_components/bootstrap/dist/js/bootstrap.js',
            'datepicker.js'
        ], 'public/js/datepicker.js')
        .version(['js/all.js', 'css/app.css', 'css/jenn.css', 'css/jenn2.css', 'js/jenn.js'])
        //.browserSync({
        //    proxy: 'imdb.app'
        //})
    ;
});
