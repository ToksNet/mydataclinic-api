<?php

namespace App\Http\Controllers\Api\DataCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use  Illuminate\Support\Facades\Validator;
use App\Http\Resources\DataUserResource;

class LoginController extends Controller
{
    //

    public function store(Request $request){

        try{
            $validatedData =  Validator::make($request->all(), [
                'collection_email' => ['bail', 'required', 'string', 'email'],
                'password' => ['bail', 'required', 'string'],
            ]);
            
            if($validatedData->fails()){
                $response = collect([
                'message' => 'credentials validation failed',
                'status' => 'error',
                'errors' => $validatedData->errors(),
            ]);
                return response()->json($response, 401);
            }
    
            if(Auth::attempt($request->only('collection_email', 'password'))){
                $collectionUser = Auth::user();
                // json response to send to the frontend
                $response = collect([
                    'message' => 'Collection authentication sucessful',
                    'status' => 'successful',
                    'token' => $collectionUser->createToken("Organisation Api Token", 
                                        ['dataCollection:create','dataCollection:delete', 'dataCollection:update']
                                        )->plainTextToken,
                    'data' => new DataUserResource($collectionUser),
                    'errors' => [],
                ]);

                return response()->json($response, 201);
            }

            // json response to send to the frontend
            $response = collect([
                'message' => 'Authentication failed, invalid credentials',
                'status' => 'failed',
                'errors' => ['wrong email or password'],
            ]);

            return response()->json($response, 401);
        }catch(\Throwable $throwable){
            $reponse = collect([
                'message' => $throwable->getMessage(),
                'status' => 'error',
                'errors' => $throwable->getTrace(),
            ]);
            return response()->json($response, 500);
        }
        

    }

}