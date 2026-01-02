<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'pengelola') {
                return redirect('/pengelola/dashboard');
            }

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            // DEFAULT
            return redirect('/wali/home');
        }

        return $next($request);
    }
}
