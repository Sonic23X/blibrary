<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($user))
            return response()->json(['message' => 'El correo y/o la contraseña son incorrectos'], 401);

        $token = Auth::user()->createToken('libraryToken')->accessToken;

        return response()->json(['token' => $token, 'user' => Auth::user()], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'session cerrada'], 200);
    }
}
