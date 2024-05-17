<?php

namespace App\Http\Controllers\Api\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRules;
use App\Models\Organisation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules;


class PasswordController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validate user data
            $validatedData = Validator::make($request->all(), [
                'id' => ['required', 'exists:organisations'],
                'old_password' => ['bail', 'required', 'string'],
                'password' => ['bail', 'required', 'string', 'confirmed',PasswordRules::min(8)->mixedCase()->numbers()->symbols()],
            ]);

            if ($validatedData->fails()) {
                $response = collect([
                    'message' => 'organisation password reset unsuccessful',
                    'status' => 'error',
                    'errors' => $validatedData->errors(),
                ]);
                return response()->json($response, 401);
            }

            $organisation = Organisation::findOrFail($request->id);

             // Reset the password
             $organisation->password = bcrypt($request->password);
             $organisation->save();
          
              // Invalidate and delete existing user tokens
              $organisation->tokens()->delete();

              // Create a new token for the organisation
              $token = $organisation->createToken('OrganisationToken', ['dataCollection:create', 'dataCollection:delete', 'dataCollection:update'])->plainTextToken;

            $response = collect([
                'message' => 'Organisation password update successful',
                'status' => 'success',
                'token' => $token,
                'errors' => [],
            ]);
            
            return response()->json($response, 201);

        } catch (\Throwable $throwable) {
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
