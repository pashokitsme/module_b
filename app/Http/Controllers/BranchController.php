<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenericCreateRequest;
use App\Models\Region;

class BranchController extends Controller
{
  public function store(GenericCreateRequest $req, $regionId)
  {
    return $this->json(Region::get($regionId)->createOrganization($req->name));
  }

  public function all($regionId)
  {
    return $this->json(Region::get($regionId)->organizations->all());
  }

  public function delete($regionId, $orgId)
  {
    Region::get($regionId)->organization($orgId)->delete();
    return $this->json();
  }

  public function update(GenericCreateRequest $req, $regionId, $orgId)
  {
    $org = Region::get($regionId)->organization($orgId);
    $org->update($req->all());
    return $this->json($org);
  }
}