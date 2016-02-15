<?php

namespace App\Policies;

use App\Game;
use App\User;
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

    public function delete(User $user, Game $game)
    {
        return $user->id === $game->user_id;
    }


}
