<?php

namespace App\Models;

class Region extends BaseModel
{
  protected $fillable = ['name'];

  public function organizations()
  {
    return $this->hasMany(Organization::class);
  }

  public function createOrganization($name): Organization
  {
    $org = Organization::create(['region_id' => $this->id, 'name' => $name]);
    $org->save();
    return $org;
  }

  public function organization($id): Organization
  {
    return Organization::get($id);
  }
}