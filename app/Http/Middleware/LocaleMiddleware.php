<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;
use App;

class LocaleMiddleware
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
        $locale = config()['app']['locale'] ?? 'en';

        if (!empty(session('locale'))) {
            $locale = session('locale');
        } else if (!empty(Auth::user()->locale)) {
            $locale = Auth::user()->locale;
            session(['locale' => Auth::user()->locale]);
        }

        App::setLocale($locale);
        return $next($request);
    }
}
