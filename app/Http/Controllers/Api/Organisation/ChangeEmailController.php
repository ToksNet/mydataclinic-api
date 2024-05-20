<?php

namespace App\Http\Controllers\Api\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Organisation;
use Mail;
use App\Mail\RegisterMail;

class ChangeEmailController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validate the new email address
            $validatedData = Validator::make($request->all(), [
                'id' => ['required', 'exists:organisations,id'],
                'current_email' => ['bail', 'required', 'string', 'email'],
                'new_email' => ['bail', 'required', 'string', 'email', 'unique:organisations,business_email'],
            ]);

            if ($validatedData->fails()) {
                $response = collect([
                    'message' => 'Email update failed',
                    'status' => 'error',
                    'errors' => $validatedData->errors(),
                ]);
                return response()->json($response, 401); 
            }

            // Find the organization with the id
            $organisation = Organisation::findOrFail($request->id);

            // Update the email address
            $organisation->business_email = strtolower($request->new_email);
            $organisation->email_verified_at = null; // Reset email verification status
            $organisation->save();

            // Resend the verification email
            Mail::to($organisation->business_email)->send(new RegisterMail($organisation));

            // JSON response to send to the frontend
            $response = collect([
                'message' => 'Email updated successfully. Please verify your new email to complete registration.',
                'status' => 'pending_verification',
                'errors' => [],
            ]);

            return response()->json($response, 200);
        } catch (\Throwable $throwable) {
            $response = collect([
                'message' => $throwable->getMessage(),
                'status' => 'error',
                'errors' => $throwable->getTrace(),
            ]);

            return response()->json($response, 500);
        }
    }
}
