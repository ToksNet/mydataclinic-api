<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\Models\Organisation;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
                /**
     * Verify the user's email address.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'hash' => 'required',
            'expires' => 'required',
            'signature' => 'required',
        ]);

        $user = Organisation::find($request->id);

        if (!$user || !hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Invalid verification link.'], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email address already verified.'], 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['message' => 'Email address successfully verified.']);
    }
}
