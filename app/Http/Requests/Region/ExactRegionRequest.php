<?php

namespace App\Http\Requests\Region;

use App\Http\Requests\Request;
use App\Models\Region;

class ExactRegionRequest extends Request
{
    protected $params = ['region'];

    public function rules()
    {
        return ['region' => ['integer', 'required', 'exists:regions,id']];
    }

    public function passedValidation()
    {
        $this->region = Region::find($this->region);
    }
}
