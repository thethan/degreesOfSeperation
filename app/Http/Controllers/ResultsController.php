<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Results;

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
