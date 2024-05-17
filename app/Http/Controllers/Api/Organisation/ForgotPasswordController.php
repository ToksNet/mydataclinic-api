<?php

namespace App\Http\Controllers\Api\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Organisation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Events\PasswordResetLinkSent;
use Illuminate\Support\Str;



class ForgotPasswordController extends Controller
{

    
    /**
     * Handle the incoming request to send a password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    

     public function sendResetLink(Request $request)
     {
         $request->validate(['business_email' => 'required|email']);
         $email = $request->input('business_email');
         $status = Password::broker('organisations')->sendResetLink(['email' => $email]);
 
         if ($status === Password::RESET_LINK_SENT) {
             $user = Organisation::where('business_email', $email)->first();
             if ($user) {
                 $resetLink = url('/password/reset/' . $status); // This needs actual implementation detail
                 event(new PasswordResetLinkSent($user, $resetLink));
             }
             return response()->json(['message' => __($status)]);
         }
         
         $response = collect([
            'message' => __($status),
            'status' => 'error',
            'errors' => $throwable->getTrace(),
            ]);

            return response()->json($response, 400);
 
         
     }
     
     
}
