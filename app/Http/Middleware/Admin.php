<?php

namespace selftotten\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(401, 'unauthorized');
        }


        return $next($request);
    }
}
