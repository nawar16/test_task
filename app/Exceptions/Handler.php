<?php

namespace App\Exceptions;


use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {        
        $this->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json(['status' => 'failed', 'message' => 'Model not found'], 404);
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json(['status' => 'failed', 'message' => 'Data not found'], 404);
        });
    }
}
