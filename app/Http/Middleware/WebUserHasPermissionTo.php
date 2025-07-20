<?php

namespace App\Http\Middleware;

use App\Helpers\UserHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebUserHasPermissionTo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        $check = UserHelper::isUserAdminHasPermissionTo($permission);

        if (! $check) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
