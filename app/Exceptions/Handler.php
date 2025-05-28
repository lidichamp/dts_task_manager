<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The exception types that should not be reported.
     */
    protected $dontReport = [];

    /**
     * The inputs that should never be flashed for validation exceptions.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register any exception reporting callbacks.
     *
     * This is a hook Laravel provides in case you want to log custom errors
     * or send them to external services like Sentry, Bugsnag, etc.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // You can log or report exceptions here if needed
        });
    }

    /**
     * Customise the response for API requests.
     * Ensures all errors are returned as JSON, never HTML.
     */
    public function render($request, Throwable $exception): JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        // If the request is coming from an API or expects JSON
        if ($request->expectsJson()) {

            // If a model (e.g., Task) isn't found, return a 404 with JSON
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Resource not found.'
                ], 404);
            }

            // If the user hits a route that doesn't exist, also return a 404
            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => 'Endpoint not found.'
                ], 404);
            }

            // Catch-all for all other exceptions — show message and class name
            return response()->json([
                'message' => $exception->getMessage() ?: 'An error occurred.',
                'exception' => class_basename($exception),
            ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
        }

        // If it's not an API request, fall back to Laravel’s default behaviour
        return parent::render($request, $exception);
    }



    
    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json([
            'message' => 'Validation failed.',
            'errors' => $exception->errors(),
        ], 422);
    }
}
