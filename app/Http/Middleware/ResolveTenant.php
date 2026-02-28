<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $host  = $request->getHost();
        $parts = explode('.', $host);

        $subdomain = $parts[0] ?? null;

        if (! $subdomain) {
            abort(404);
        }

        app()->instance('currentTenant', \App\Models\Tenant::where('domain', $subdomain)->first());

        return $next($request);
    }
}
