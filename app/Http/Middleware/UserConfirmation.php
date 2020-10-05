<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserConfirmation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                return $next($request);
            }
        }
        abort(404);
    }
}
