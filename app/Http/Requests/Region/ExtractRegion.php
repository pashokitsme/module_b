<?php

namespace App\Http\Requests\Region;

use App\Models\Region;

trait ExtractRegion
{
  public function __construct()
  {
    $this->params = ['region'];
  }

  public function extractRegion()
  {
    return ['region' => ['integer', 'required', 'exists:regions,id']];
  }

  public function rules()
  {
    return $this->extractRegion();
  }

  public function passedValidation()
  {
    $this->region = Region::find($this->region);
  }
}
