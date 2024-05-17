<?php

namespace App\Http\Controllers\API\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrganisationResource;


class VerifyPasswordController extends Controller
{
    

    public function store(Request $request)
    {

             
   
        $id = $request->id;
      

        $organisation = Organisation::find($id);
      

   
        if (!$request->hasValidSignature()) {

            
            
            // json response to send to the frontend
            $response = collect([
                'message' => 'verify-token link expired. Kindly request a new link.',
                'status' => 'error',
                'errors' => [
                    "expiration error"
                ],
                
            ]);

            
            $status_code = 401;
        }else{
         
            // json response to send to the frontend
            $response = collect([
                'message' => 'verify-token complete.',
                'status' => 'success',
                'errors' => [],
                'data' => new OrganisationResource($organisation),
                
            ]);
            //    dd($organisation);
            
            $status_code = 201;
            
        }
        return response()->json($response, $status_code);
        
        
    }
}
