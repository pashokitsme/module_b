<?php

namespace App\Http\Requests\Region;

use App\Http\Requests\Request;

class ExactRegionRequest extends Request
{
    protected $params = ['id'];

    public function rules()
    {
        return ['id' => ['required', 'exists:regions,id']];
    }
}
