<?php

namespace App\Http\Controllers\Api\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Password as PasswordBroker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\Organisation;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Validator;




class ResetPasswordController extends Controller 
{
    public function reset(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = Validator::make($request->all(), [
                'id' => ['required', 'exists:organisations'],
                'password' => ['required', 'string', 'confirmed', PasswordRules::min(8)->mixedCase()->numbers()->symbols()],
            ]);

            // If validation fails, return an error message and description
            if ($validatedData->fails()) {
                $response = collect([
                    'message' => 'Data validation error',
                    'status' => 'error',
                    'errors' => $validatedData->errors(),
                ]);

                return response()->json($response, 401);
            }

            // Find the organisation by ID
            $organisation = Organisation::findOrFail($request->id);

            // Reset the password
            $organisation->password = bcrypt($request->password);
            $organisation->save();

            // Invalidate and delete existing user tokens
            $organisation->tokens()->delete();

            // Create a new token for the organisation
            $token = $organisation->createToken('OrganisationToken', ['dataCollection:create', 'dataCollection:delete', 'dataCollection:update'])->plainTextToken;

            // JSON response to send to the frontend
            $response = collect([
                'message' => 'Organisation password reset successful',
                'status' => 'success',
                'token' => $token,
                'errors' => [],
            ]);

            return response()->json($response, 201);
        } catch (\Throwable $throwable) {
            // Handle any exceptions
            $response = collect([
                'message' => $throwable->getMessage(),
                'status' => 'error',
                'errors' => $throwable->getTrace(),
                'resend_link' => true,
            ]);
            return response()->json($response, 500);
        }
    }
        
}

