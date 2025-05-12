<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah pengguna yang sedang login memiliki role sesuai yang dibutuhkan
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // Jika tidak, arahkan ke halaman atau beri respon lain
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}