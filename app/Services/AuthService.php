<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;

class AuthService {
    public function oauth(Collection $validated) {
        return Socialite::driver($validated->get('provider'))->userFromToken($validated->get('token'));
    }

    public function login(Collection $credentials) {

        if (!Auth::attempt($credentials->toArray())){
            return response()->json([
                'success' => false,
                'global' => false,
                'error' => [
                    'email' => [
                        'The credentials provided cannot be found'
                    ]
                ],
                'message' => 'Invalid Credentials',
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(Collection $credentials) {
        $user = User::firstOrCreate([
            'first_name' => $credentials->get('first_name'),
            'last_name' => $credentials->get('first_name'),
            'email' => $credentials->get('email'),
            'password' => Hash::make($credentials->get('password'))
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(User $user) {
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => "Logged out successfully",
            'success' => true
        ]);
    }
}
