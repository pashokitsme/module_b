<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
  protected $params = [];

  protected function prepareForValidation()
  {
    $this->merge(array_combine($this->params, array_map(function ($param) {
      return $this->route($param);
    }, $this->params)));
  }

  protected function failedValidation(Validator $validator)
  {
    throw new ValidationException($validator, response()->json([
      'data' => [
        'error' => 'Validation error',
        'details' => $validator->errors(),
      ],
      'status' => 'error'
    ]), 400);
  }

  public function rules()
  {
    return [];
  }
}
