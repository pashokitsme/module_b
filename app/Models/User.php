<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

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
