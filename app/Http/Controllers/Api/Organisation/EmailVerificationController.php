<?php

namespace App\Http\Controllers\Api\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;

class EmailVerificationController extends Controller
{
    //

    public function store(Request $request, string $id){
        if (!$request->hasValidSignature()) {
            // json response to send to the frontend
            $response = collect([
                'message' => 'verification link expired. Kindly request a new link.',
                'status' => 'error',
                'errors' => [
                    "expiration error"
                ],
            ]);

            $status_code = 401;
        }else{
            $organisation = Organisation::find($request->id);
            $organisation->email_verified_at = Now();
            $organisation->save();
            // json response to send to the frontend
            $response = collect([
                'message' => 'verification complete.',
                'status' => 'success',
                'errors' => [],
            ]);
            $status_code = 201;
            
        }
        return response()->json($response, $status_code);
        
        
    }
}
