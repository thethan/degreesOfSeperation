<?php

namespace App\Http\Controllers;

use App\Results;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    public function index($gameId)
    {
        $results = Results::where('game_id', $gameId)->where('validated', 1)->get();
        var_dump(count($results));
        foreach($results as $result){
            var_dump($result);
        }
    }
}
