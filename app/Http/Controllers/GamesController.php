<?php

namespace App\Http\Controllers;

use App\Game;
use App\Actors;
use App\Http\Requests;
use App\Jobs\CacheFind;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::userGames(Auth::user()->id);

        $return = [];
        foreach($games as $key => $game){

            $game =  $this->gameReadable($game);
            $return[] = $game;
        }

        return view('games.index')->with('games', $return);
    }

    protected function gameReadable(Game $game)
    {
        $game = $this->startReadable($game);
        $game = $this->endReadable($game);
        return $game;
    }

    protected function startReadable(Game $game)
    {
        $name = 'person/'.$game->start;
        $cache = Cache::get($name);

        if(!$cache){
            $actors = new Actors();
            $cache = $this->dispatch(new CacheFind($actors, $game->start));
        }
        $obj = $this->dealWithPersonCache($cache);
        $game->start = $obj->name;
        return $game;

    }

    protected function endReadable(Game $game)
    {
        $name = 'person/'.$game->end;
        $cache = Cache::get($name);


        if(!$cache){
            $actors = new Actors();
            $cache = $this->dispatch(new CacheFind($actors, $game->end));
        }
        $obj = $this->dealWithPersonCache($cache);
        $game->end = $obj->name;

        return $game;
    }
    public function create()
    {

    }

    /**
     * @param Requests\GameFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Requests\GameFormRequest $request)
    {
        $inputs = $request->except(['_token']);

        $game = new Game();

        $game->user_id = Auth::user()->id;

        foreach($inputs as $key => $value){
           $game->$key = $value;
        }

        $game->save();

        return redirect('/games', 302);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $game = Game::find($id);


    }

    protected function dealWithPersonCache($cache)
    {
        $obj =  json_decode($cache);

        return $obj;
    }

}
