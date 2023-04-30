<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\Request;
use App\Models\Consultant;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  public function login(LoginRequest $req): JsonResponse
  {
    $authorize = function ($model) use ($req): string {
      if (!$x = $model::where('email', $req->email)->where('password', $req->password)->first())
        return null;
      $x->bearer = Str::random();
      $x->save();
      return $x->bearer;
    };

    if (!$token = $authorize(Admin::class) && !$token = $authorize(Consultant::class))
      return $this->error('Credentials are incorrect');
    return $this->json(['token' => $token]);
  }

  public function logout(Request $req): JsonResponse
  {
    $req->user->tokens()->delete();
    return $this->json(['message' => 'Unauthorized']);
  }

  public function me(Request $req)
  {
    $me = $req->user;
    $me['role'] = $me->role();
    return $this->json($me);
  }
}