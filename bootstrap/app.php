<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        health: '/up',
        using: function () {

            Route::middleware('api')
                ->prefix('api/v1')
                ->name('api.')
                ->group(base_path('routes/api.php'));

            Route::middleware(['api', 'auth:sanctum'])
                ->prefix('api/v1')
                ->name('api.private')
                ->group(base_path('routes/private.php'));

            Route::middleware('api')
                ->prefix('api/v1/auth')
                ->name('auth.')
                ->group(base_path('routes/auth.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized or Invalid resource identifier',
                'global' => true
            ], 404);
        });
    })->create();
