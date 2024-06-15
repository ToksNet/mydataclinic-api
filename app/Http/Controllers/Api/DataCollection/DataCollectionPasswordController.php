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
                'collection_id' => ['bail', 'required', 'exists:users,id'],
                'old_password' => ['bail', 'required', 'string', 'current_password'],
                'password' => ['bail', 'required', 'string', 'confirmed', 'max:16',  PasswordRules::min(8)->mixedCase()->numbers()->symbols()],
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


             // Reset the password
             $user = User::findOrFail($request->collection_id);
             $user->password = bcrypt($request->password);
             $user->save();


            $response = collect([
                'message' => 'Collection password update successfully',
                'status' => 'success',
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
