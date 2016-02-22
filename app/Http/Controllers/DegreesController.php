<?php

namespace selftotten\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use selftotten\Actors;
use selftotten\Events\DegreeSaved;
use selftotten\Http\Requests;
use selftotten\Jobs\CacheFind;
use selftotten\Jobs\CaxheCredits;
use selftotten\Movies;
use selftotten\Results;
use selftotten\TMDBModel;


class DegreesController extends Controller
{
    public function index()
    {
//        $user = factory(\selftotten\User::class)->create();

        return view('welcome');
    }
    /**
     * @param $search
     */
    public function searchMovies($search)
    {
        $movie = new TMDBModel();

        $return = $movie->search($search);
        return response()->json($return);
    }

    /**
     * @param $search
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPeople($search)
    {
        $movie = new Actors();

        $return = $movie->search($search);

        return response()->json($return);
    }

    /**
     * @param $id
     */
    public function findMovies($id)
    {
        $movie = new Movies();

        $movie->find($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function returnDos(Request $request)
    {
        return $request->session()->get('dos');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveDegrees(Request $request, $id)
    {

        $result = Results::findOrFail($id);

        $array = $request->only(['id', 'type']);

        $this->getSearchObject($array['id'], $array['type']);

        $dos = json_decode($result->results);

        $obj = (object)($request->except('_token'));

        $dos[] = $obj;

        $userId = Auth::user()->id;

        event(new DegreeSaved($userId, $dos, $result->game_id));

        $result->saveDos($dos);


        return response(null,204);

    }

    protected function getSearchObject($id, $type)
    {
        switch ($type) {
            case 'movie':
                $movies = new Movies($id);
                break;

            case 'person':
                $movies = new Actors($id);
                break;

        }

//        $movies->find($id);
        $this->dispatch(new CacheFind($movies, $id));
//        $movies->setCredits($id);
//        $this->dispatch(new CacheCredits($movies));


    }

    public function getResult(Request $request, $gameId, $id)
    {
        $result = Results::findOrFail($id);

        $userId = Auth::user()->id;

        event(new DegreeSaved($userId, json_decode($result->results), $result->game_id));

        return response()->json(json_decode($result->results));

    }

    public function personSelected(Request $request, $id)
    {


        $this->getSearchObject($id, 'person');

    }

    public function clearDegrees(Request $request)
    {
        $request->session()->forget('dos');

        return response()->json([],204);
    }

    protected function getCredits($id)
    {
        $movie = new Movies();

        $movie->find($id);
    }

    protected function fireTheEvent()
    {

    }


}
