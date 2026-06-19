<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Agar user login nahi hai, ya uska role 'admin' nahi hai, toh access DENIED!
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Isay seedha 403 Forbidden ka thappar parre ga
            abort(403, 'UNAUTHORIZED ACCESS. This incident has been logged.'); 
        }

        return $next($request);
    }
}