<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends BaseModel
{
  protected $table = 'auth_tokens';
  protected $fillable = ['token', 'user_id'];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
