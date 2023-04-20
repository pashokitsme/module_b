<?php

namespace App\Models;

class Consultant extends BaseModel
{
  protected $fillable = ['user_id', 'organization_id'];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function organization()
  {
    return $this->belongsTo(Organization::class, 'organization_id', 'id');
  }
}