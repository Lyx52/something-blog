<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens([]);

        // Redirect to login page
        $middleware->redirectGuestsTo(fn(Request $request) => route('auth.login.page'));

        $environment = env('APP_ENV');

        switch ($environment) {
            case 'production':
                $middleware->trustProxies(
                    at: '*',
                    headers: Request::HEADER_X_FORWARDED_FOR |
                    Request::HEADER_X_FORWARDED_HOST |
                    Request::HEADER_X_FORWARDED_PORT |
                    Request::HEADER_X_FORWARDED_PROTO
                );
                break;

            default:
                $middleware->trustProxies(
                    at: ['127.0.0.1', '::1'],
                    headers: Request::HEADER_X_FORWARDED_FOR |
                    Request::HEADER_X_FORWARDED_PROTO
                );
        }

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Not found
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->view('pages.404', [], 404);
        });

        // Access denied
        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            return response()->view('pages.403', [], 403);
        });

        // Unknown exception
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, Request $request) {
            Log::error("Internal Server Exception {message}", [
                'message' => $e->getMessage(),
            ]);

            return response()->view('pages.500', [], 500);
        });
    })
    ->create();
