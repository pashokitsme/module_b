<?php

namespace App\Http\Requests;

class CreateRegionOrOrganizationRequest extends Request
{
  public function rules()
  {
    return ['name' => ['string', 'required']];
  }
}