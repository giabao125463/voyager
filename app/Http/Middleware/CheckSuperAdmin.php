<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $loginUser = \Auth::user();
        if (!isset($loginUser) || !$loginUser->hasRole('super')) {
            abort(404);
        }

        return $next($request);
    }
}
