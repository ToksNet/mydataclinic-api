<?php

namespace App\Http\Controllers\Api\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OrganisationResource;
use Auth;
use  Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function store(Request $request){
       // using a try catch block
        try{
            // validate user data
            $validatedData = Validator::make($request->all(), 
            [
                'business_email' => ['bail', 'required', 'string', 'email'],
                'password' => ['bail', 'required', 'string'],
            ]);

            // if validation fails, return an error message and description
            if($validatedData->fails()){
                $response = collect([
                'message' => 'Data validation error',
                'status' => 'error',
                'errors' => $validatedData->errors(),
            ]);
                return response()->json($response, 401);
            }
            $credentials = $request->only('business_email', 'password');
            // try and authenticate an organisation
            if(Auth::guard('organisation')->attempt($credentials)) {
                $organisation = Auth::guard('organisation')->user();
               
                if (!$organisation->hasVerifiedEmail()) {
                    $response = collect([
        
                        'message' => 'You need to verify your email to log in.',
                        'status' => 'error',
                        'errors' => ['verification error'],
                        
                    ]);
    
                    return response()->json($response, 201);
                }

                // invalidate and delete existing user token
                $usertoken = $organisation->tokens()->delete();
                // create new user token 
                $token = $organisation->createToken('OrganisationToken',
                                                ['dataCollection:create','dataCollection:delete', 'dataCollection:update'])
                                                ->plainTextToken;
                // json response to send to the frontend
                $response = collect([
        
                    'message' => 'organisation login sucessful',
                    'status' => 'successful',
                    'token' => $token,
                    'errors' => [],
                    'data' => new OrganisationResource($organisation),
                ]);

                return response()->json($response, 201);
            }
            // return json with error if auth attempt failed
            $response = collect([
                'message' => 'Authentication error',
                'status' => 'error',
                'errors' =>['Authentication error.Invalid login credentials'],
            ]);
            return response()->json($response, 401);

        }catch(\Throwable $throwable){
            $response = collect([
                'message' => $throwable->getMessage(),
                'status' => 'error',
                'errors' => $throwable->getTrace(),
            ]);
            return response()->json($response, 500);
        }
        
    }
}
