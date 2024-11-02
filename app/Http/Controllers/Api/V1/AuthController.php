<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register a new user and generate token.
     */
    public function register(Request $request)
    {
        // if (auth('sanctum')->check()) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['user' => $user], 201);
        // }
    }

    /**
     * Login user and generate token with optional admin scope.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        $user->tokens()->delete();

        $token = $user->is_admin
            ? $user->createToken('Admin Token', ['admin'])->plainTextToken
            : $user->createToken('User Token')->plainTextToken;

        // Remove the guest identifier cookie (if it exists)
        $response = response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);

        return $response->withCookie(
            cookie(
                'guest_identifier',      // name
                '',                      // value
                -1,                      // minutes (negative to expire immediately)
                '/',                     // path
                null,                    // domain
                config('app.env') !== 'local', // secure
                true,                    // httpOnly
                false,                   // raw
                'Lax'                    // sameSite
            )
        );
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
