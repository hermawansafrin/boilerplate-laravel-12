<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJsonRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Make sure all api endpoints has application/json header
         */
        if ($request->is('api/v1/*')) {
            $request->headers->set('Accept', 'application/json');
            $request->headers->set('Content-Type', 'application/json');
        }

        return $next($request);
    }
}
