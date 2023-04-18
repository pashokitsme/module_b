<?php

namespace App\Http\Requests\Region;

class UpdateRegionRequest extends CreateRegionRequest
{
    use ExtractRegion;

    public function rules() {
        return array_merge(parent::rules(), $this->extractRegion());
    }
}
