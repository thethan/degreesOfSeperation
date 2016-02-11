<?php

namespace App\Http\Controllers;

use App\Jobs\ReadyPlayerOne;
use Gate;
use App\Game;
use App\Results;
use App\Http\Requests;
use App\Events\DegreeSaved;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PlayController extends Controller
{
    public function show(Request $request, $id, $resultId = null)
    {

        $userId = Auth::user()->id;

        $value = Cache::get('user_'.$userId.'_game_'.$id);

        $result = Results::findOrNew($resultId);

        $game = Game::findOrFail($id);

        if($resultId) {$this->authorize('show', [$result, $game]); }


        $result = dispatch(new ReadyPlayerOne($game, $resultId));



//        $game->getItemsForViewing();

        //Broadcast
        //event(new DegreeSaved($userId, [], $result->game_id));


        return view('play.game')
            ->with('game', $game)
            ->with('result', $result);


    }

    public function index()
    {
        $games = Game::paginate(15);

        foreach($games as &$game){
            $game->getItemsForViewing();
        }

        return view('play.index')->with('games', $games);
    }

    public function validate()
    {

    }
}
