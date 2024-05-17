<?php

namespace App\Http\Controllers\Api\DataCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Organisation;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules;

class DataCollectionPasswordController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validate user data
            $validatedData = Validator::make($request->all(), [
                'organisation_id' => ['required', 'exists:organisations,id'],
                'old_password' => ['bail', 'required', 'string'],
                'password' => ['bail', 'required', 'string', 'confirmed',PasswordRules::min(8)->mixedCase()->numbers()->symbols()],
            ]);

            if ($validatedData->fails()) {
                $response = collect([
                    'message' => 'Collection password reset unsuccessful',
                    'status' => 'error',
                    'errors' => $validatedData->errors(),
                ]);
                return response()->json($response, 401);
            }

            // Retrieve the organisation based on the provided organisation_id
            $organisation = Organisation::findOrFail($request->organisation_id);


             // Reset the password
             $user = $organisation->user;
             $user->password = bcrypt($request->password);
             $user->save();
           

              // Invalidate and delete existing user tokens
              $organisation->tokens()->delete();

              // Create a new token for the user
              $token = $user->createToken('UserToken', ['dataCollection:create', 'dataCollection:delete', 'dataCollection:update'])->plainTextToken;

            $response = collect([
                'message' => 'Collection password update successful',
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
