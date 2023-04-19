<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
  protected $hidden = ['updated_at', 'created_at'];
}
