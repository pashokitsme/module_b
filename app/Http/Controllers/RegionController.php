<?php

namespace App\Http\Controllers;

use App\Http\Requests\Region\CreateRegionRequest;
use App\Http\Requests\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function all(Request $req)
    {
        return $this->json(Region::all()->all());
    }

    public function store(CreateRegionRequest $req)
    {
        $region = Region::create($req->all());
        $region->save();
        return $this->json($region);
    }
}
