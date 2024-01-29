<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        return ( $exception->guards()[0])
        ? response()->json(['message' => 'token no autorizado','exception'=>$exception->getMessage(), 'statusService' => 'errorTokenNoAutorized', 'code' => 401, 'status' => false, 'errorCode' => $exception], 401)
            : redirect()->guest(route('login'));

    }
    
}
