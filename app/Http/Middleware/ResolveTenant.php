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
    $host = $request->getHost();
    $subdomain = explode('.', $host)[0];

    $tenant = \App\Models\Tenant::where('domain', $subdomain)->first();

    if (!$tenant) {
        abort(404, 'Tenant not found');
    }

    app()->instance('currentTenant', $tenant);

    return $next($request);
}
}
