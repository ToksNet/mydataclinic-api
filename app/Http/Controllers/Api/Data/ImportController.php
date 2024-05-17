<?php

namespace App\Http\Controllers\Api\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Artisan;


class ImportController extends Controller
{
    //

    public function store(Request $request){
    
        try{
        $data = $request->all();
        // remove the first two index of the data array as they contain info about the data but not real data
        $dataForInsert = array_slice($data, 2);
        // // index 0 of array contains information about the data collection
        // // find the data collection to stack data
        $dataCollection = User::find($data[0]['collection_id']);
        
        //table settings
        //get table name from collection slug, modify table name to model name
        $tableName = $dataCollection->collection_slug;
        $seperatedModelName = explode('_', $tableName);
        $modelName = '';
        foreach($seperatedModelName as $brokenName){
            $modelName.=''.ucfirst($brokenName);
        }
      $modelCreated = "App\\Models\\$modelName";

        // if table exists, stack data else create new table with model and migration
        if(Schema::hasTable($tableName)) {
            // The table exists 

            try {

                // data for insert contains and array of arrays
                //loop through each 
                foreach($dataForInsert as $singleDataInsert){
                   $insertData = $modelCreated::create($singleDataInsert);
                }
  
                // The record was successfully entered
                $error = [];
                $status = 'success';
                $message = 'you have similar data stored, your data has been stacked';

            } catch (\Exception $e) {
                // The record was not entered
                $error = "Record insertion failed: " . $e->getMessage();
                $status = 'error';
                $message = 'data headers are not the same, you can create a data collection to save data or adjust data headers';
            }
            
            // return the data from the collection
            $response = collect([
                'message' => $message,
                'status' => $status,
                'errors' => $error,
                'data' => $dataForInsert,
            ]);
            return response()->json($response, 201);
        }
        
        // set header row to index position of two = [1]
        // index 1 of array contains information about the data, icnluding column names and data types
        $headerRow = $data[1];
        $index = 0;
        // // loop throught header row to grab date coloumns
        foreach($headerRow as $columName => $dataType){
         
            $dataToMatch = $data[2][$columName];
            // trying matching string data and getting suggested date types 
            // such as date, long text or single Characters
            $datePattern = '/^\d{1,}\/\d{1,}\/\d{4}$/';
            $dateTimePattern = '/^\d{1,}\/\d{1,}\/\d{4} \d{1,}:\d{1,}$/';
            $dateTimeSecondsPattern = '/^\d{2}\/\d{2}\/\d{4} \d{1,}:\d{2}:\d{2}$/';
            $dateTimePatternWithMediterran = '/^\d{2}\/\d{2}\/\d{4} \d{1,}:\d{2} \b{am|pm}$/';
            $dateTimeSecondsPatternWithMediterran = '/^\d{2}\/\d{2}\/\d{4} \d{1,}:\d{2,}:\d{2,} \b{am|pm}$/';
            $yearPattern = '/^\d{4}/';
            $YearAndMonthPattern = '/^\d{1,}\/\d{4}/';
            
            if($headerRow[$columName] == 'string' && is_string($dataToMatch)){
                if(Str::length($dataToMatch) > 254 ){
                    $dateType = 'LongText';
                }else{
                    if(strtotime($dataToMatch) !== false){
                        $dateType = 'dateTime';
                        if(preg_match($dateTimePattern, $dataToMatch)){
                          $dateType = 'dateTime';
                        }else{
                            // match date
                            $dateType = 'date';
                        }
                    }else{
                        $dateType = 'LongText';
                    }
                }
            }elseif(is_bool($dataToMatch)){
                $dateType = 'boolean';
            }elseif(is_array($dataToMatch)){
                $dateType = 'json';
            }elseif(is_numeric($dataToMatch)){
                $dateType = 'integer';
            }else{
                $dateType = 'LongText';
            }
            
            $schema[str_replace(" ", "_", trim(strtolower($columName), " "))] = $dateType;
            // if()
            $index++;
           
        }
        // create migrations
        $migrationCreateTime = Now()->format('Y_m_d_His');
        $migrationFileName =  $migrationCreateTime.'_create_'.$tableName.'_table';
        $migrationFilePath = database_path('migrations/'. $migrationFileName.'.php');
        $phptag = '?php';
        // fill the view with dynamic column content
        $migrationContent = view('dynamicMigrationTemplates.index', compact('tableName', 'schema', 'phptag') )->render();
        // move file into migrations folder   
        file_put_contents($migrationFilePath,  $migrationContent);

        // create model and prefile
        $modelFilePath = app_path('Models/'. $modelName.'.php');
        $modelContent = view('dynamicModels.index', compact('tableName', 'schema', 'phptag', 'modelName') )->render();
        // move mdel into models folder
        file_put_contents($modelFilePath,  $modelContent);

        // migrate the table using artisan commands
        Artisan::call('migrate', ['--path' => 'database/migrations', '--force' => true]);
      
       foreach($dataForInsert as $singleDataInsert){
            $insertData = $modelCreated::create($singleDataInsert);
        }

        // return the data from the collection
        $response = collect([
            'message' => 'Data stored sucessfully',
            'status' => 'success',
            'errors' =>[],
            'data' => $dataForInsert,
        ]);
        return response()->json($response, 201); 
        
        }catch(\Exception $e){
            
                // The record was not entered
                $error = "Could not import data: " . $e->getMessage();
                $status = 'error';
                $message = 'data importation failed';
        }
        
       
    }
    
}
