<?php

namespace App\Http\Middleware;

use App\Helpers\UserHelper;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiUserHasPermissionTo
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        $userHelper = app(UserHelper::class);
        $check = $userHelper->isUserAdminHasPermissionTo($permission);

        if (! $check) {
            return $this->sendError(__('messages.auth.unauthorized'), 403);
        }

        return $next($request);
    }
}
