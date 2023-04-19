<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
  protected $rules = [];
  protected $params = [];

  protected function prepareForValidation()
  {
    $keys = array_keys($this->params);
    $x = array_map(function ($param) {
      return $this->route($param);
    }, $keys);

    $this->merge(array_combine($keys, $x));
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

  protected function passedValidation()
  {
    foreach ($this->params as $param => $closure) {
      $this[$param] = $closure($param);
    }
  }

  protected function validate()
  {
    return [];
  }

  public function rules()
  {
    return array_merge($this->rules, $this->validate());
  }
}