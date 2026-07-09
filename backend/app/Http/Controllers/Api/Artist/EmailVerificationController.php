<?php

namespace App\Http\Controllers\Api\Artist;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    /**
     * Verify Email
     */
    public function verify(
        Request $request,
        $id,
        $hash
    ) {

        $user = User::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Verify Signed URL
        |--------------------------------------------------------------------------
        */

        if (! URL::hasValidSignature($request)) {

            abort(403, 'Invalid verification link.');

        }

        /*
        |--------------------------------------------------------------------------
        | Verify Email Hash
        |--------------------------------------------------------------------------
        */

        if (! hash_equals(
            sha1($user->getEmailForVerification()),
            $hash
        )) {

            abort(403, 'Invalid verification link.');

        }

        /*
        |--------------------------------------------------------------------------
        | Mark Verified
        |--------------------------------------------------------------------------
        */

        if (! $user->hasVerifiedEmail()) {

            $user->markEmailAsVerified();

            event(new Verified($user));

        }

        return redirect(
            rtrim(config('app.frontend_url'), '/')
            . '/await-approval?verified=1'
        );
    }

    /**
     * Resend Verification Email
     */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->json([

            'success' => true,

            'message' => 'Verification email sent.'

        ]);
    }
}
