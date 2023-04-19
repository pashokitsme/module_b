<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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

    return response()->json(['data' => ['error' => $e->getMessage(), 'trace' => $e->getTrace()], 'status' => 'error'], 500);
  }
}
