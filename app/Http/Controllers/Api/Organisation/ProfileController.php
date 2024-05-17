<?php

namespace App\Http\Controllers\API\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Organisation;
use  Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrganisationResource;


class ProfileController extends Controller
{
    //
    public function update(Request $request, $id)
    {
        try {
            // Validate user data
            $validatedData = Validator::make($request->all(), [
                'firstname' => ['bail', 'nullable', 'string', 'min:3'],
                'lastname' => ['bail', 'nullable', 'string', 'min:3'],
                'business_name' => ['bail', 'nullable', 'string', 'min:3'],
                'business_phone' => ['bail', 'nullable', 'string'], 
                'business_industry' => ['bail', 'nullable', 'string', 'min:3'], 
                'business_country' => ['bail', 'nullable', 'string', 'min:3'],  
                'business_state' => ['bail', 'nullable', 'string', 'min:3'], 
                'business_city' => ['bail', 'nullable', 'string', 'min:3'], 
                'business_address' => ['bail', 'nullable', 'string', 'min:3'], 
                'business_postal_code' => ['bail', 'nullable', 'string', 'min:3'],
            ]);

            if ($validatedData->fails()) {
                $response = collect([
                    'message' => 'validation failed',
                    'status' => 'error',
                    'errors' => $validatedData->errors(),
                ]);
                return response()->json($response, 401);
            }

            // Find organization by id
            $organization = Organisation::findOrFail($id);

            // Update organization
            $organization->update([
                'firstname' => strtolower($request->firstname) ?? $organization->firstname,
                'lastname' => strtolower($request->lastname) ?? $organization->lastname,
                'business_name' => strtolower($request->business_name) ?? $organization->business_name,
                'business_phone' => $request->business_phone ?? $organization->business_phone,
                'business_industry' => strtolower($request->business_industry) ?? $organization->business_industry,
                'business_country' => strtolower($request->business_country) ?? $organization->business_country,  
                'business_state' => strtolower($request->business_state) ?? $organization->business_state, 
                'business_city' => strtolower($request->business_city) ?? $organization->business_city, 
                'business_address' => strtolower($request->business_address) ?? $organization->business_address, 
                'business_postal_code' => strtolower($request->business_postal_code) ?? $organization->business_postal_code,
            ]);

            // JSON response to send to the frontend
            $response = collect([
                'message' => 'Organization updated successfully.',
                'status' => 'success',
                'organization' => new OrganisationResource($organization),
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
