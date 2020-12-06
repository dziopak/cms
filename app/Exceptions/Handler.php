<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{

    private $responses = [
        NotExistingException::class,
        TokenVerificationException::class,
        ValidationException::class,
        TransactionException::class,
        ModelUpdateException::class,
        ModelStoreException::class,
        ModelDestroyException::class
    ];


    protected $dontReport = [
        //
    ];


    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    public function report(Throwable $exception)
    {
        parent::report($exception);
    }


    public function render($request, Throwable $e)
    {
        if (in_array(get_class($e), $this->responses)) {
            return $e->response();
        } else if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }
        return parent::render($request, $e);
    }


    protected function prepareException(Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return new HttpException(
                419,
                "{$exception->getMessage()}. Please clear your browser cookies and try again.",
                $exception
            );
        }

        return parent::prepareException($exception);
    }
}
