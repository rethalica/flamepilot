<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah user sudah login
        if (Auth::check()) {
            // Mengecek apakah role user adalah 'admin'
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }

            // Jika user bukan admin, redirect ke halaman lain
            return to_route('dashboard')->with('error', 'You do not have admin access');
        }


        return $next($request);
    }
}
