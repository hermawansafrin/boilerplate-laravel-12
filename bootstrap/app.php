<?php

use App\Helpers\ResponseUtil;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias middleware
        $middleware->alias([
            'web.user_has_permission_to' => \App\Http\Middleware\WebUserHasPermissionTo::class,
        ]);

        // Add middleware for API routes
        $middleware->api(append: [
            \App\Http\Middleware\EnsureJsonRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle authentication exceptions for API
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            if ($request->expectsJson() || $request->is('api/v1/*')) {
                return response()->json(ResponseUtil::makeError('Unauthenticated.'), 401);
            }
        });

        // Handle 404 Not Found exceptions for API
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson() || $request->is('api/v1/*')) {
                return response()->json(ResponseUtil::makeError('Endpoint not found.'), 404);
            }
        });

        // Handle 405 Method Not Allowed exceptions for API
        $exceptions->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->expectsJson() || $request->is('api/v1/*')) {
                return response()->json(ResponseUtil::makeError('Method not allowed.'), 405);
            }
        });
    })->create();
