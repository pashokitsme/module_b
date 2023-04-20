<?php

namespace App\Models;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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

  public function delete()
  {
    if ($this->organizations->count() > 0)
      throw new BadRequestHttpException('Region ' . $this->id . ' contains organizations');
    return $this->delete();
  }

  public function organization($id): Organization
  {
    return Organization::get($id);
  }
}