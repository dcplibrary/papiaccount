<?php

namespace Dcplibrary\PAPIAccount\App\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessSecret
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if AccessSecret exists in session
        if (! session('AccessSecret')) {
            // Redirect to root path if AccessSecret is null or doesn't exist
            return redirect('/');
        }

        return $next($request);
    }
}
