<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenericCreateRequest;
use App\Models\Region;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
  public function all(): JsonResponse
  {
    return $this->json(Region::all()->all());
  }

  public function exact($id): JsonResponse
  {
    return $this->json(Region::get($id));
  }

  public function update(GenericCreateRequest $req, $id): JsonResponse
  {
    $region = Region::get($id);
    $region->update($req->all());
    return $this->json($region);
  }

  public function delete($id): JsonResponse
  {
    Region::get($id)->delete();
    return $this->json();
  }

  public function store(GenericCreateRequest $req)
  {
    $region = Region::create($req->all());
    $region->save();
    return $this->json($region);
  }
}