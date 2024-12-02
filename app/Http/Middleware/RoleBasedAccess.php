<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleBasedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Jika pengguna adalah admin dan mencoba mengakses halaman user
            if (Auth::user()->role === 'admin' && $request->is('user/*')) {
                return redirect()->route('Admin.dashboard'); // Arahkan ke halaman admin
            }

            // Jika pengguna adalah user dan mencoba mengakses halaman admin
            if (Auth::user()->role === 'user' && $request->is('admin/*')) {
                return redirect()->route('dashboard'); // Arahkan ke halaman user
            }
        }

        // Lanjutkan request jika tidak ada masalah dengan akses
        return $next($request);
    }
}

