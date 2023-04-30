<?php

namespace App\Models;

class Admin extends BaseModel
{
  protected $fillable = ['name', 'email', 'password'];

  public function role(): string
  {
    return 'admin';
  }
}