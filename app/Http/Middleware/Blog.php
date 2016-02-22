<?php

namespace selftotten\Http\Middleware;

use Closure;

class Blog
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
        if (!auth()->user()->hasPermission('manage_blog')) {
            abort(401, 'unauthorized');
        }

        return $next($request);
    }
}
