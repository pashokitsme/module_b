<?php

namespace App\Http\Requests\Region;

use App\Http\Requests\Request;

class ExactRegionRequest extends Request
{
  use ExtractRegion;
}