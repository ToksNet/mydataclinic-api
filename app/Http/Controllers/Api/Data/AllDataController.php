<?php

namespace App\Http\Controllers\Api\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DataCollection;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class AllDataController extends Controller
{
    //

    public function index(String $collection_id){
        try{
            // find user/ data collection
            $collection = User::find($collection_id);

            // grab collection slug which is the table name of the related collection
            $tableName = $collection->collection_slug;

            // if table does not exists, stack data else create new table with model and migration
            if(!Schema::hasTable($tableName)) {
            // The table does not exists 
            // json response to send to the frontend
                $response = collect([
                    'message' => 'collection has no data yet',
                    'status' => 'successful',
                    'data' => [],
                    'errors' => [],
                    
                ]);
        
                return response()->json($response, 201);
            }
            // get data from the table
            $data = DB::table($tableName)->get();

            // json response to send to the frontend
            $response = collect([
                'message' => 'all data returned',
                'status' => 'successful',
                'data' => $data,
                'errors' => [],
                
            ]);
    // 'data' => DataCollection::collection($data),
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
