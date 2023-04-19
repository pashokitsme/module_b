<?php

namespace App\Http\Requests;

class LoginRequest extends Request
{
  public function rules()
  {
    return [
      'email' => ['email', 'required', 'exists:users,email'],
      'password' => ['string', 'required']
    ];
  }
}