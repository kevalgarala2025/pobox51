<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIs(ALIAS_SUPERADMIN.'*')) {
            if (Auth::guard(GUARD_SUPERADMIN)->check()) {
                return redirect()->route(ALIAS_SUPERADMIN.'dashboard');
            }
        }
        if ($request->routeIs(ALIAS_USER.'*') || \Route::currentRouteAction() === 'App\Http\Controllers\User\HomeController@index') {
            if (Auth::guard(GUARD_USER)->check()) {
                return redirect()->route(ALIAS_USER.'dashboard');
            }
        }
        return $next($request);
    }
}
