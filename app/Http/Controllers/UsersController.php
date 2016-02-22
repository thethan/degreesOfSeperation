<?php

namespace selftotten\Http\Controllers;


use selftotten\Http\Requests;
use selftotten\User;

class UsersController extends Controller
{
    //
    /**
     * Show a list of Admin Posts.
     */
    public function index()
    {
        $this->authorize('index', auth()->user());

        $users = User::with('roles.permissions', 'posts', 'comments')->get();
        return view('users.index', compact('users'));
    }
}
