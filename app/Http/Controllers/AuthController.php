<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
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
}
