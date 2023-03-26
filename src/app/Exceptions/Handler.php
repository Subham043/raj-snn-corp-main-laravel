<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Contracts\Encryption\DecryptException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ThrottleRequestsException && $request->wantsJson()) {
            return response()->json([
                'status' => false,
                'error' => 'Too many attempts, please try again after sometime',
            ], 429);
        }

        if ($exception instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], 405);
        }

        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'error' => 'Oops! No data found ',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException && $request->wantsJson()) {
            return response()->json([
                'error' => 'Oops! Invalid link',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof DecryptException && $request->wantsJson()) {
            return response()->json([
                'error' => 'Oops! You have entered invalid link',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ModelNotFoundException) {
            throw new NotFoundHttpException('Oops! No data found');
        }

        if ($exception instanceof DecryptException) {
            throw new NotFoundHttpException('Oops! You have entered invalid link');
        }

        return parent::render($request, $exception);
    }
}
