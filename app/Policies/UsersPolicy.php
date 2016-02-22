<?php

namespace selftotten\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use selftotten\User;

class UsersPolicy
{

    use HandlesAuthorization, AdminOverride;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before()
    {
        if ($this->checkIfEitherManagerOrAdmin()) {
            return true;
        }
    }

    public function checkUsersPermission(User $user, $role)
    {

        return $user->hasRole($role);
    }


}
