<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class User extends BaseModel
{
  protected $fillable = ['name', 'role_id', 'email', 'password'];

  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class, 'role_id');
  }

  public function isAdmin(): bool
  {
    return $this->role->id == Role::ADMIN;
  }

  public function isConsultant(): bool
  {
    return $this->role->id == Role::CONSULTANT;
  }

  public function tokens()
  {
    return Token::where('user_id', $this->id);
  }

  public function newToken(): Token
  {
    $token = Token::create(['token' => Str::random(), 'user_id' => $this->id]);
    $token->save();
    return $token;
  }
}
