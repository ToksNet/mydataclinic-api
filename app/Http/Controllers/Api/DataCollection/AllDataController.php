<?php

namespace App\Http\Controllers\API\DataCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\DataUserResource;

class AllDataController extends Controller
{
    //
    public function index($organisation_id)
    {
        try{
            $collectionUser = User::where('organisation_id', $organisation_id)->get();

            $response = collect([
                'message' => 'all collection returned',
                'status' => 'successful',
                'data' => new DataUserResource($collectionUser),
                'errors' => [],
            ]);

            return response()->json($response, 200);
        }catch(\Exception $e){
            
            // The record was not entered
            $error = "Could not import data: " . $e->getMessage();
            $status = 'error';
            $message = 'could not get organization collection';
            
            $response = collect([
                'message' => $message,
                'status' =>  $status,
                'errors' => [$error],
            ]);
            return response()->json($response, 501);
        }
        
    }
}
