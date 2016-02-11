<?php

namespace App\Policies;

use App\Game;
use App\User;
use App\Results;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResultsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(Results $results, User $user, Game $game  )
    {


        return $user->id == $results->user_id;
    }

    public function show( User $user, Results $results, Game  $game)
    {
        return $user->id == $results->user_id && $game->id == $results->game_id;
    }
}
