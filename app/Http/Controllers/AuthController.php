<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
  public function login(LoginRequest $req): JsonResponse
  {
    if (!$user = User::where('email', $req->email)->where('password', $req->password)->first())
      return $this->error('Credentials are incorrect');
    $token = $user->newToken();
    return $this->json(['token' => $token->token]);
  }

  public function logout(Request $req): JsonResponse
  {
    $req->user->tokens()->delete();
    return $this->json(['message' => 'Unauthorized']);
  }

  public function me(Request $req)
  {
    $me = $req->user;
    $me['role'] = $me->role->name;
    unset($me['role_id']);
    return $this->json($me);
  }
}