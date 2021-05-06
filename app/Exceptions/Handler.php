<?php

namespace App\Exceptions;

use App\Traits\APIResponser;
use function class_basename;
use function dd;
use HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use function response;
use function strtolower;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler {
    use APIResponser;
    /**
     * A list of the exception types that are not reported.
     * @var array
     */
    protected $dontReport = [//
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     * @return void
     */
    public function register() {
        $this->reportable(function(Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e) {
        if ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        if ($e instanceof ModelNotFoundException) {
            return $this->errorResponse(class_basename($e->getModel()) . ' not found', 404);
        }

        if ($e instanceof AuthenticationException) {
            return $this->errorResponse($request, 403);
        }

        if ($e instanceof AuthorizationException) {
            return $this->errorResponse($e->getMessage(), 403);
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->errorResponse('The specific URL cannot be found', 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('The specified request for this request if not allowed', 405);
        }

        if ($e instanceof HttpException) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }

        if($e instanceof Exception) {

        }

        return $this->errorResponse('Something went wrong, please try again.', $e->getCode());
    }

    public function convertValidationExceptionToResponse(ValidationException $e, $request) {
        return $this->errorResponse($e->validator->errors()->getMessages(), 422);
    }
}
