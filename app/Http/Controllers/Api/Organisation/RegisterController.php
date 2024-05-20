<?php

namespace App\Http\Controllers\Api\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Organisation;
use  Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\RegisterMail;

class RegisterController extends Controller
{
    //

    public function store(Request $request){

        try{
            // validate user date
            $validatedData = Validator::make($request->all(), 
            [
                'firstname' => ['bail', 'required', 'string', 'min:3'],
                'lastname' => ['bail', 'required', 'string', 'min:3'],
                'business_name' => ['bail', 'required', 'string', 'min:3'],
                'business_email' => ['bail', 'required', 'string', 'email', 'unique:'.Organisation::class],
                'password' => ['bail', 'required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            ]
            );

            if($validatedData->fails()){ 
                $response = collect([
                'message' => 'organisation account creation failed',
                'status' => 'error',
                'errors' => $validatedData->errors(),
            ]);
                return response()->json($response, 401);
            }

            // persisting data into database after validating
            $organization = Organisation::create([
                'firstname' => strtolower($request->firstname),
                'lastname' => strtolower($request->lastname),
                'business_name' => strtolower($request->business_name),
                'business_email' => strtolower($request->business_email),
                'password' => Hash::make($request->password),
                'email_verified_at' => Null,
                'status' => 'active',

                
            ]);

            // send verification mail
            Mail::to($organization->business_email)->send(new RegisterMail($organization));
            // After creating the organization
            // $organization->sendEmailVerificationNotification();


            // json response to send to the frontend
            $response = collect([
                'message' => 'Please verify your email to complete registration.',
                'status' => 'pending_verification',
                'token' => $organization->createToken("Organisation Api Token", 
                                    ['dataCollection:create','dataCollection:delete', 'dataCollection:update']
                                    )->plainTextToken,
                'errors' => [],
            ]);

            return response()->json($response, 201);
                // dd($request->all());

        }catch(\Throwable $throwable){
            $response = collect([
                        'message' => $throwable->getMessage(),
                        'status' => 'error',
                        'errors' => $throwable->getTrace(),
                        ]);

            return response()->json($response, 500);
        }
    }
    
    public function resend(string $business_email){

        try{
            $organization =  Organisation::where('business_email', $business_email)->first();
            if(is_null($organization)){
                $response = collect([
                    'message' => 'unauthorized email',
                    'status' => 'error',
                    'errors' => ["email not found"],
                ]);
    
                return response()->json($response, 401);
            }elseif(!is_null($organization->email_verified_at)){
                 $response = collect([
                'message' => 'email already verified',
                'status' => 'verified',
                'errors' => [],
            ]);

            return response()->json($response, 200);
            }
            // resend verification mail
            Mail::to($business_email)->send(new RegisterMail($organization));
            // json response to send to the frontend
            $response = collect([
                'message' => 'We sent a new verification link to the email you provided',
                'status' => 'reverification',
                'errors' => [],
            ]);

            return response()->json($response, 200);
                // dd($request->all());
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
