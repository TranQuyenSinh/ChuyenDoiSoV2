<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $url = url($_SERVER['REQUEST_URI']);
        if (Auth::check()) return $next($request);
        else return redirect()->intended(env('APP_URL') . 'auth/login?url=' . $url);
        return $next($request);
    }
}
