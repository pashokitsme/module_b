<?php

namespace App\Http\Requests\Region;

use App\Models\Region;

trait ExtractRegion
{
  public function __construct()
  {
    $this->params['region'] = function ($x) {
      $this->region = Region::find($this->region);
    };

    $this->rules['region'] = ['integer', 'required', 'exists:regions,id'];
  }
}