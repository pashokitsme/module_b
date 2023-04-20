<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateConsultantRequest extends Request
{
  public function rules()
  {
    return [
      'firstname' => ['string', 'required'],
      'secondname' => ['string', 'required'],
      'email' => ['email', 'required', 'unique:users,email'],
      'password' => ['string', 'required']
    ];
  }
}