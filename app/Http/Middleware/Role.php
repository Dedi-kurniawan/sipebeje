<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $role = is_array($roles) ? $roles : explode('|', $roles);
        $user = Auth::user()->role;
        if (in_array($user, $role)) {
            return $next($request);
        }
        return abort(401);
    }
}
