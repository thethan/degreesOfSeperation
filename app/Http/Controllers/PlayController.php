<?php

namespace App\Http\Controllers;

use App\Jobs\ReadyPlayerOne;
use App\Jobs\ValidateResults;
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

        $game = Game::findOrFail($id);
        $result = Results::find($resultId);
        if(empty($result)) {
            $result = Results::where('game_id', $id)->where('user_id',$userId)->orderBy('id', 'DESC')->where('validated', 0)->first();

            if(!empty($result)){
                $resultId = $result->id;
            }
        }

        if($resultId) {$this->authorize('show', [$result, $game]); }

        $result = dispatch(new ReadyPlayerOne($game, $resultId));

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

    public function validateResults(Request $request, $resultId )
    {
        $result = Results::findOrFail($resultId);

        $resultClass = $this->dispatch(new ValidateResults($result));

        return response()->json(json_decode($resultClass->results));
    }
}
