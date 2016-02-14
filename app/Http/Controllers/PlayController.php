<?php

namespace App\Http\Controllers;

use App\Jobs\ReadyPlayerOne;
use App\Jobs\ValidateResults;
use Gate;
use App\Game;
use App\Results;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PlayController extends Controller
{
    public function show(Request $request, $id, $resultId = null)
    {

        $userId = Auth::user()->id;

        $game = Game::findOrFail($id);
        $result = Results::find($resultId);

        if(empty($result)) {
            $result = Results::where('game_id', $id)
                ->where('user_id',$userId)
                ->where('validated','=', 0)
                ->orderBy('id', 'DESC')->first();

            if(!empty($result)){
                $resultId = $result->id;
            }
        }

        if($resultId) {
            $this->authorize('show', [$result, $game]);
        }


        $result = dispatch(new ReadyPlayerOne($game, $resultId));

        $results = Results::where('game_id', $id)
                ->where('validated',1)
                ->where('steps','>',0)->get();

        foreach($results as &$completedResult){
            $completedResult->user;
        }

        return view('play.game')
            ->with('game', $game)
            ->with('result', $result)
            ->with('results', $results);

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

        $resultClass->results = json_decode($resultClass->results);

        $return = $resultClass;

        return response()->json($return);
    }

    protected function statusCodes($correct)
    {
        switch ($correct){
            case null:
                return 304;
                break;
            case 0:
                return 100;

        }
    }
}
