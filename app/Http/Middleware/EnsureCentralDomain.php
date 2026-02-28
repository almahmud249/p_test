<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCentralDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost(); 
        // Example: admin.myapp.com

        $parts = explode('.', $host);

        if (count($parts) < 3 || $parts[0] !== 'admin') {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
