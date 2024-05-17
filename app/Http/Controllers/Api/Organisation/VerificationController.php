<?php

// namespace App\Http\Controllers\API\Organisation;

// use App\Http\Controllers\Controller;
// use App\Models\Organisation;
// use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Verify the user's email.
     *
     * @param  Request $request
     * @param  string $token
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $token)
    {
        $request->validate(['token' => 'required|string']); 
    
        $user = Organisation::where('verification_token', $token)
                             ->where('token_expiration', '>', now()) // Ensure token is not expired
                             ->first();
    
        if (!$user)     {
            return response()->json(['message' => 'Invalid or expired token.'], 404);
        }
    
        if (!$user->business_email_verified_at) {
            $user->business_email_verified_at = now(); // Set the verification time
            $user->verification_token = null; // Clear token after use
            $user->token_expiration = null; // Clear token expiration
            $user->save();
    
            event(new \App\Events\OrganisationVerified($user));
    
            return response()->json(['message' => 'Email successfully verified.'], 200);
        }
    
        return response()->json(['message' => 'Email is already verified.'], 400);
    }
    

}
