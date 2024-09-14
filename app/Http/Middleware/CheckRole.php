<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->intended('auth/login?url=' . url($_SERVER['REQUEST_URI']));
        }
        // Để tạm thời, khi chưa phân quyền
        return $next($request);
        // ========================================

        $user = Auth::user();
        $userRoles = collect($user->roles)->pluck('name')->all();
        foreach ($roles as $role) {
            $hasRole = in_array($role, $userRoles);
            if ($hasRole) return $next($request);
        }
        return redirect()->intended('auth/not-permis');
    }
}
