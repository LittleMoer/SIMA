<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class isViewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->role_id == 3 ) {
            return $next($request);
        }

        // Redirect or return an error response if not an admin
        return response()->view('403', [], 403);
    }
}
