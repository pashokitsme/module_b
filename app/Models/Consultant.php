<?php

namespace App\Models;

class Consultant extends BaseModel
{
  protected $fillable = ['name', 'email', 'password', 'branch_id'];
}