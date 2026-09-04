<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')->withErrors(['Silakan login terlebih dahulu.']);
        }

        // Mapping role_id dari database
        $roleMap = [
            1 => 'admin',
            2 => 'kasir',
        ];

        // Ambil string role berdasarkan role_id milik user
        $userRole = $roleMap[$request->user()->role_id] ?? null;

        // Cek apakah role user ada dalam list role yang diperbolehkan di route
        if (!in_array($userRole, $roles)) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        return $next($request);
    }
}