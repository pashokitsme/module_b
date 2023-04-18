<?php

namespace App\Http\Controllers;

use App\Http\Requests\Region\CreateRegionRequest;
use App\Http\Requests\Region\ExactRegionRequest;
use App\Http\Requests\Region\UpdateRegionRequest;
use App\Models\Region;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
    public function all(): JsonResponse
    {
        return $this->json(Region::all()->all());
    }

    public function exact(ExactRegionRequest $req): JsonResponse
    {
        return $this->json($req->region);
    }

    public function update(UpdateRegionRequest $req): JsonResponse
    {
        $req->region->update($req->all());
        return $this->json($req->region);
    }

    public function delete(ExactRegionRequest $req): JsonResponse
    {
        $req->region->delete();
        return $this->json();
    }

    public function store(CreateRegionRequest $req)
    {
        $region = Region::create($req->all());
        $region->save();
        return $this->json($region);
    }
}
