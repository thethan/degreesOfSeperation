<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'degrees'], function () {

    Route::group(['as' => 'search::'], function () {
        Route::get('/search/movies/{search}', 'DegreesController@searchMovies')->name('movies');

        Route::get('/search/people/{search}', 'DegreesController@searchPeople')->name('people');

    });
    Route::get('/movies/{id}', 'DegreesController@findMovies');

    Route::group(['as' => 'degrees::'], function () {
        Route::put('/degrees/save/{id}', 'DegreesController@saveDegrees');

        Route::get('/degrees/{gameId}/{id}', 'DegreesController@getResult');

        Route::put('/degrees/person/{id}', 'DegreesController@personSelected');

    });

    Route::group(['as' => 'play::'], function () {
        Route::get('/play', 'PlayController@index')->name('index');

        Route::post('/play/validate/{resultId?}', 'PlayController@validateResults');

        Route::get('/play/{id}/{resultId?}', 'PlayController@show')->name('game');
    });

    Route::group(['as' => 'games::'], function () {
        Route::get('/games', 'GamesController@index');

        Route::post('/games', 'GamesController@save');

        Route::delete('/games/{id}', 'GamesController@destroy')->name('delete');

        Route::get('/games/{id}', 'GamesController@show');

        Route::get('/games/{gameId}/results', 'ResultsController@index');

    });


    Route::get('/clear', 'DegreesController@clearDegrees');

});

Route::get('fire', function () {
    // this fires the event
    event(new App\Events\EventName());
    return "event fired";
});

Route::get('test', function () {
    // this checks for the event
    return view('test');
});
Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/jenn/{id}', function ($id) {
            return view('jenn.blade' . $id);
        });
    });
});

