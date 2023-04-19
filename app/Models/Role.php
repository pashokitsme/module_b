<?php

namespace App\Models;

class Role extends BaseModel
{
    public const ADMIN = 1;
    public const CONSULTANT = 2;

    protected $fillable = ['name'];
}
