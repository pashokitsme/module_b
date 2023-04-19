<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
  public function handle(Request $req, Closure $next)
  {
    return $next($req)->header('Access-Control-Allow-Origin', '*');
  }
}