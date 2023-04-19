<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  protected function json($data = null, $code = 200): JsonResponse
  {
    if ($data)
      return response()->json(['status' => 'ok', 'data' => $data], $code);
    return response()->json(['status' => 'ok'], $code);
  }

  protected function error($message, $code = 400): JsonResponse
  {
    return response()->json(['status' => 'error', 'data' => ['error' => $message]], $code);
  }
}