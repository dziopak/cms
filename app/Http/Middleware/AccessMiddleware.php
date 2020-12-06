<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::check()) return redirect('/');

        $user = Auth::user();
        if ($user->role_id == "0") return $next($request);
        if ($user->role->hasAccess($permission) !== true) return redirect('/');
        return $next($request);
    }
}
