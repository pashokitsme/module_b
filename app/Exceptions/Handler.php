<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var array<int, class-string<Throwable>>
   */
  protected $dontReport = [
    //
  ];

  public function render($request, Throwable $e)
  {
    if ($e instanceof ValidationException)
      return $e->response;

    if ($e instanceof NotFoundHttpException)
      return response()->json(['status' => 'error', 'data' => ['error' => $e->getMessage() == null ? 'Route not found' : $e->getMessage()]], 404);

    return response()->json(['status' => 'error', 'data' => ['error' => $e->getMessage(), 'trace' => $e->getTrace()]], 500);
  }
}