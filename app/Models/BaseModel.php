<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseModel extends Model
{
  protected $hidden = ['updated_at', 'created_at'];

  public static function get($id)
  {
    if (!$target = static::class::find($id))
      throw new NotFoundHttpException();
    return $target;
  }
}