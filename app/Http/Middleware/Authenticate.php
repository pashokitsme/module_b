<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Consultant;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class Authenticate
{
  public function handle(Request $req, Closure $next)
  {
    if (!$user = Admin::where('bearer', $req->bearerToken())->first() && !$user = Consultant::where('bearer', $req->bearerToken())->first())
      return response()->json(['status' => 'error', 'data' => ['error' => 'Unauthenticated']], 401);

    return $next($req->merge(['user' => $user]));
  }
}

abstract class IsRole
{
  protected function check(Request $req, Closure $next, $requiredRole)
  {
    if ($req->user->role() != $requiredRole)
      return response()->json(['status' => 'error', 'data' => ['error' => 'Access denied']], 403);
    return $next($req);
  }
}

class IsAdmin extends IsRole
{
  public function handle(Request $req, Closure $next)
  {
    return $this->check($req, $next, 'admin');
  }
}

class IsConsultant extends IsRole
{
  public function handle(Request $req, Closure $next)
  {
    return $this->check($req, $next, 'consultant');
  }
}