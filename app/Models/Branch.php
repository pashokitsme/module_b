<?php

namespace App\Models;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Branch extends BaseModel
{
  protected $fillable = ['region_id', 'name'];

  public function consultants()
  {
    return $this->hasMany(Consultant::class, 'branch_id');
  }

  public function delete()
  {
    if ($this->consultants->count() > 0)
      throw new BadRequestHttpException('Branch ' . $this->id . ' contains consultants');
    return $this->delete();
  }
}