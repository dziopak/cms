<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Route;
use Auth;

class SocialProfileMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $route = Route::getRoutes()->match($request)->getName();

            if (substr($route, 0, 6) !== 'front.') return $next($request);
            if ($route == 'front.user.social.update' || $route == 'front.user.social') return $next($request);
            if (!empty($user->password) && !empty($user->email)) return $next($request);

            return redirect(route('front.user.social'));
        }
        return $next($request);
    }
}
