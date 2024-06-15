<?php

namespace App\Http\Controllers\Api\DataCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use  Illuminate\Support\Facades\Validator;
use Auth;

class RegisterController extends Controller
{
    //

    public function store(Request $request){

        try {
            $validatedData = Validator::make($request->all(), [
                'organisation_id' => ['bail', 'required', 'string', 'min:20'],
                'collection_name' => ['bail', 'required', 'string', 'min:3'],
                'collection_description' => ['bail', 'required', 'string', 'min:3'],
                'collection_email' => ['bail', 'required', 'string', 'email', 'unique:'.User::class],
                'password' => ['bail', 'required', 'string', 'confirmed', Password::min(8)->mixedCase()->symbols()->numbers()],
            ]);

            if($validatedData->fails()){
                $response = collect([
                'message' => 'could not create data collection',
                'status' => 'error',
                'errors' => $validatedData->errors(),
            ]);
                return response()->json($response, 401);
            }

    
            // trim spaces and replace dashes with underscores
            $slug = str_replace(' ', '_', trim($request->collection_name));
            $slug = str_replace('-', '_', $slug);
            $slug = $slug.'_'.$request->organisation_id;
            
            $dataCollection = User::firstOrCreate(
                ['collection_name' => $request->collection_name,],
                [
                'organisation_id' => $request->organisation_id,
                'collection_email' => $request->collection_email,
                'collection_description' => $request->collection_description,
                'collection_slug' => $slug,
                'password' => Hash::make($request->password),
            ]);
            $dataCollection->save();
            // json response to send to the frontend
            $response = collect([
                'message' => 'a new data collection has been created',
                'status' => 'successful',
                'errors' => [],
            ]);
    
            return response()->json($response, 201);
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
