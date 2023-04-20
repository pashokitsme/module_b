<?php

namespace App\Http\Requests;

class GenericCreateRequest extends Request
{
  public function rules()
  {
    return ['name' => ['string', 'required']];
  }
}