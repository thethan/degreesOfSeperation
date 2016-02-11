<?php

namespace App\Policies;

use App\Results;
use App\User;
use App\Game;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicies
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

    public function update(User $user, Game $game)
    {
        return $user->id === $game->user_id;
    }


}
