<?php

namespace selftotten\Http\Controllers;

use selftotten\Http\Requests;
use selftotten\Results;

class ResultsController extends Controller
{
    public function index($gameId)
    {
        $results = Results::where('game_id', $gameId)->where('validated', 1)->get();
        foreach($results as $result){
            var_dump($result);
        }
    }
}
