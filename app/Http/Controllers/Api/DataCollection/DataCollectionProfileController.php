<?php

namespace App\Http\Controllers\Api\DataCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Organisation;
use App\Models\User;
use  Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrganisationResource;


class DataCollectionProfileController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validate user data
            $validatedData = Validator::make($request->all(), [
                'organisation_id' => ['required', 'exists:organisations,id'],
                'collection_name' => ['bail', 'nullable', 'string', 'min:3'],
                'collection_email' => ['bail','nullable', 'string', 'email'],
                'collection_description' => ['bail', 'nullable', 'string', 'min:3'], 
                'collection_slug' => ['bail', 'nullable', 'string', 'min:3'], 
                
            ]);

            if ($validatedData->fails()) {
                $response = collect([
                    'message' => 'validation failed',
                    'status' => 'error',
                    'errors' => $validatedData->errors(),
                ]);
                return response()->json($response, 401);
            }

             // Find organisation by id
             $organisation = Organisation::findOrFail($request->organisation_id);

             // Find user associated with the organisation
             $user = User::where('organisation_id', $request->organisation_id)->firstOrFail();
 
            // Update organization
            $user->update([
                'collection_name' => strtolower($request->collection_name) ?? $user->collection_name,
                'collection_email' => strtolower($request->collection_email) ?? $user->collection_email,
                'collection_description' => strtolower($request->collection_description) ?? $user->collection_description,
                'collection_slug' => strtolower($request->collection_slug) ?? $user->collection_slug, 
            ]);

            // JSON response to send to the frontend
            $response = collect([
                'message' => 'Data Collection updated successfully.',
                'status' => 'success',
                'organization' => new OrganisationResource($organisation),
                'user' => $user,
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
