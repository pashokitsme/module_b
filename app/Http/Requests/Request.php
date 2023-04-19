<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
  protected function failedValidation(Validator $validator)
  {
    throw new ValidationException($validator, response()->json([
      'data' => [
        'error' => 'Validation error',
        'details' => $validator->errors(),
      ],
      'status' => 'error'
    ], 400));
  }
}