<?php

namespace selftotten\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use selftotten\Game;
use selftotten\Results;
use selftotten\User;

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
