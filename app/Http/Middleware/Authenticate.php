<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\Token;
use Closure;
use Illuminate\Http\Request;

class Authenticate
{
  public function handle(Request $req, Closure $next)
  {
    if (!$token = Token::where('token', $req->bearerToken())->first())
      return response()->json(['status' => 'error', 'data' => ['error' => 'Unauthenticated']], 401);

    return $next($req->merge(['user' => $token->user]));
  }
}

abstract class IsRole
{
  protected function check(Request $req, Closure $next, $requiredRole)
  {
    if ($req->user->role->id != $requiredRole)
      return response()->json(['status' => 'error', 'data' => ['error' => 'Access denied']], 403);
    return $next($req);
  }
}

class IsAdmin extends IsRole
{
  public function handle(Request $req, Closure $next)
  {
    return $this->check($req, $next, Role::ADMIN);
  }
}

class IsConsultant extends IsRole
{
  public function handle(Request $req, Closure $next)
  {
    return $this->check($req, $next, Role::CONSULTANT);
  }
}