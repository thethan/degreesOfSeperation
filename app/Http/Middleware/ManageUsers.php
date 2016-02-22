<?php

namespace selftotten\Http\Middleware;

use Closure;

class ManageUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!auth()->user()->hasPermission('manage_users')) {
            abort(401, 'unauthorized');
        }

        return $next($request);
    }
}
