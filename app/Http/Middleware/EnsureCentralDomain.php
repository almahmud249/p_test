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
        $host  = $request->getHost();
        $parts = explode('.', $host);

        if (($parts[0] ?? null) !== 'admin') {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
