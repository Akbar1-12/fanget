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
        $user = User::create([

            'name' => $request->name,

            'artist_name' => $request->artist_name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'is_approved' => false,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Send Email Verification
        |--------------------------------------------------------------------------
        */

        $user->sendEmailVerificationNotification();

        return response()->json([

            'success' => true,

            'message' => 'Registration successful. Please verify your email before logging in.',

        ], 201);
    }

    /**
     * Artist Login
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        /*
        |--------------------------------------------------------------------------
        | Invalid Credentials
        |--------------------------------------------------------------------------
        */

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([

                'success' => false,

                'message' => 'Invalid email or password.',

            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Email Verification
        |--------------------------------------------------------------------------
        */

        if (!$user->hasVerifiedEmail()) {

            return response()->json([

                'success' => false,

                'verified' => false,

                'message' => 'Please verify your email address before logging in.',

            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Admin Approval
        |--------------------------------------------------------------------------
        */

        if (!$user->is_approved) {

            return response()->json([

                'success' => false,

                'approved' => false,

                'message' => 'Your account is awaiting admin approval.',

            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Create Token
        |--------------------------------------------------------------------------
        */

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
     * Current Authenticated User
     */
    public function me()
    {
        return response()->json([

            'success' => true,

            'user' => request()->user(),

        ]);
    }
}
