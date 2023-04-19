<?php

namespace App\Http\Requests\Region;

use App\Http\Requests\Request;

class CreateRegionRequest extends Request
{
  public function validate()
  {
    return ['name' => ['string', 'required']];
  }
}