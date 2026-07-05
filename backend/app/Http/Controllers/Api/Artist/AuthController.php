<?php

namespace App\Http\Controllers\Api\Artist;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register Artist
     */
    public function register(RegisterRequest $request)
    {
        User::create([

            'name' => $request->name,

            'artist_name' => $request->artist_name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'is_approved' => false,

        ]);

        return response()->json([

            'success' => true,

            'message' =>
                'Registration successful. Your account is awaiting admin approval.',

        ], 201);
    }

    /**
     * Artist Login
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([

                'success' => false,

                'message' => 'Invalid email or password.',

            ], 401);
        }

        if (!$user->is_approved) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Your account is awaiting admin approval.',

            ], 403);
        }

        $token = $user->createToken('fanget-user')->plainTextToken;

        return response()->json([

            'success' => true,

            'message' => 'Login successful.',

            'token' => $token,

            'user' => $user,

        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json([

            'success' => true,

            'message' => 'Logged out successfully.',

        ]);
    }

    /**
     * Current User
     */
    public function me()
    {
        return response()->json([

            'success' => true,

            'user' => request()->user(),

        ]);
    }
}
