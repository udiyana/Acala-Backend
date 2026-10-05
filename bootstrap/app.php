<?php

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Security headers untuk semua web response
        $middleware->web(append: [
            SecurityHeaders::class,
        ]);

        // EnsureFrontendRequestsAreStateful memungkinkan SPA (React frontend)
        // menggunakan session cookie untuk autentikasi di route /api/*.
        // Ini adalah cara resmi Laravel Sanctum untuk SPA authentication.
        // Tanpa ini, $request->session() di CmsAuthController akan error 500.
        $middleware->api(prepend: [
            EnsureFrontendRequestsAreStateful::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Tangkap RouteNotFoundException yang muncul saat auth:sanctum
        // mencoba redirect ke route bernama 'login' yang tidak terdaftar.
        // Ini terjadi ketika browser mengakses /api/* tanpa session yang valid.
        $exceptions->render(function (RouteNotFoundException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated. Silakan login melalui POST /api/cms/login',
                    'errors'  => [],
                ], 401);
            }
        });

        // Tangkap AuthenticationException langsung (untuk request dengan Accept: application/json)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated. Silakan login melalui POST /api/cms/login',
                    'errors'  => [],
                ], 401);
            }
        });
    })
    ->create();
