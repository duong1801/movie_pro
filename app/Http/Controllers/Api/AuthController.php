<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
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

//        $token = auth::user()->tokens()->where('name', 'access_token')->first();
//
//        $token->expires_at = Carbon::now()->addMinutes(10);

        $refreshToken = $user->createToken('refresh_token')->plainTextToken;

        return response()->json([
            'access_token' => $access_token,
            'refresh_token' => $refreshToken,
            'expires' => $token->expires_at
        ], 200);
    }

    public function refreshToken(Request $request)
    {

        $request->validate([
            'refresh_token' => 'required',
        ]);

        $refreshToken = $request->refresh_token;

        $token = PersonalAccessToken::find($refreshToken);

        if ($token) {

        }

    }

    public function logout()
    {

        $user = Auth::user();

        $check = $user->currentAccessToken()->delete();

        if ($check) {
            $message = "Logout Success!";
            $code = 200;
        } else {
            $message = "Logout failed!";
            $code = 400;
        }

        return response()->json([
            'message' => $message
        ], 400);

    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if($user){
            $code = 200;
            $message = 'register successfully!';
            $status = 'success';
        }else {
            $code = 400;
            $message = 'failed to register!';
            $status = 'failed';
        }

        return response()->json([
           'message' => $message,
            'status'=> $status
        ],$code);

    }
}
