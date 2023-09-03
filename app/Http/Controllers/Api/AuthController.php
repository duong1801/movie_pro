<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'authorized'
            ], 401);
        }

        $user = Auth::user();

        $newToken = $user->createToken('access_token');

        $access_token = $newToken->plainTextToken;

        $token = auth::user()->tokens()->where('name', 'access_token')->first();

        $token->expires_at = Carbon::now()->addMinutes(10);

        $refreshToken = $user->createToken('refresh_token')->plainTextToken;

        return response()->json([
            'access_token' => $access_token,
            'expires'=> $token->expires_at
        ], 200);
    }

    public function refreshToken(Request $request)
    {


    }

    public function logout()
    {
        try {
            $user = Auth::user();
            $user->tokens()->delete();
            return response()->json([
                'message' => 'Logout Success!'
            ],200);
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],400);
        }

    }
}
