<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = session('user');

        if (!$user) {
            logger('Access denied. User not logged in.');
            return redirect('/login'); // Belum login
        }

        if (!in_array($user->role, $roles)) {
            logger('Access denied. Role mismatch: ' . $user->role);
            return redirect('/404'); // Role tidak sesuai
        }

        return $next($request);
    }
}