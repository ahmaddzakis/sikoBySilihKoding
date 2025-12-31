<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // belum login
        if (! auth()->check()) {
            abort(403, 'Unauthorized');
        }

        // role tidak sesuai
        if (auth()->user()->role !== $role) {
            return redirect('/');
        }

        return $next($request);
    }
}
