<?php

namespace App\Models;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Region extends BaseModel
{
  protected $fillable = ['name'];

  public function branches()
  {
    return $this->hasMany(Branch::class);
  }

  public function createBranch($name): Branch
  {
    $org = Branch::create(['region_id' => $this->id, 'name' => $name]);
    $org->save();
    return $org;
  }

  public function delete()
  {
    if ($this->organizations->count() > 0)
      throw new BadRequestHttpException('Region ' . $this->id . ' contains organizations');
    return $this->delete();
  }

  public function branch($id): Branch
  {
    return Branch::get($id);
  }
}