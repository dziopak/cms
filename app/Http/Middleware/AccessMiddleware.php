<?php

namespace App\Http\Middleware;
use Auth;
use Role;
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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role_id == "99") {
                return $next($request);
            } else {
                $access = unserialize($user->role->access);
                if (in_array($permission, $access)) {
                    return $next($request);
                } else {
                    return redirect("/");
                }
            }
        } else {
            return redirect("/login");
        }
    }
}
