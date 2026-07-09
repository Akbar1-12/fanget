<?php

namespace App\Http\Controllers\Api\Artist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Send Reset Link
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([

            'email' => ['required', 'email'],

        ]);

        $status = Password::sendResetLink(

            $request->only('email')

        );

        return response()->json([

            'success' => $status === Password::RESET_LINK_SENT,

            'message' => __($status),

        ]);
    }

    /**
     * Reset Password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([

            'token' => ['required'],

            'email' => ['required', 'email'],

            'password' => [

                'required',

                'confirmed',

                'min:8',

            ],

        ]);

        $status = Password::reset(

            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function ($user, $password) {

                $user->forceFill([

                    'password' => Hash::make($password),

                    'remember_token' => Str::random(60),

                ])->save();

                event(new PasswordReset($user));

            }

        );

        return response()->json([

            'success' => $status === Password::PASSWORD_RESET,

            'message' => __($status),

        ]);
    }
}
