<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle rendering of exceptions for API routes
        $exceptions->render(function (Throwable $e, Request $request) {
            // Check if the request is for the 'api/*' route
            if ($request->is('api/*')) {

                // Handle AuthorizationException (e.g., 403 Forbidden from policies)
                if ($e instanceof AuthorizationException) {
                    return response()->json([
                        'message' => 'You do not have permission to perform this action.',
                    ], 403);
                }

                // Handle AuthenticationException (e.g., Not logged in)
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'message' => 'Unauthenticated.',
                    ], 401);
                }

                // Handle 404 Not Found (Model not found or invalid route or method not supported)
                if ($e instanceof ModelNotFoundException ||
                    $e instanceof NotFoundHttpException
                    || $e instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Resource not found.',
                    ], 404);
                }
                
                // default case
                // Handle 500 Internal Server Errors (Many possible causes)
                return response()->json([
                    'status' => 'error',
                    'message' => 'An internal server error occurred.',
                ], 500);
                
            }
        });

    })->create();
