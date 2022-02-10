<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FullField
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->full_field == "1") {
            return $next($request);
        }

        if (Auth::user()->role == "vendor") {
            return redirect()->route('admin.profile.vendor');
        }

        if (Auth::user()->role == "desa") {
            return redirect()->route('admin.profile.desa');
        }
    }
}
