<?php

namespace App\Http\Controllers\Api\DataCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\User; // Import the User model

class DeleteCollectionController extends Controller
{
    public function delete(Request $request, $organisation_id, $collection_id)
    {
        try {
            // Validate request data
            $request->validate([
                'collection_id' => ['required', 'exists:users,id,organisation_id,' . $organisation_id],
            ]);

            // Fetch user details
            $user = User::where('id', $collection_id)
                ->where('organisation_id', $organisation_id)
                ->firstOrFail();

            // Debug: Check if user is found
            // dd("User found: ", $user);

            // Prepare table name
            $slug = Str::slug($user->collection_name);
            $tableName = $slug . '_' . $organisation_id;

            // Drop the table if it exists
            if (Schema::hasTable($tableName)) {
                Schema::dropIfExists($tableName);

                // Debug: Confirm table deletion
                // dd("Table {$tableName} dropped.");
            }

            // Delete the user data collection record
            $user->delete();

            // Construct file paths
            $modelName = Str::studly($user->collection_name);
            $modelPath = app_path("Models/{$modelName}.php");
            $migrationFiles = glob(database_path("migrations/*_create_{$slug}_{$organisation_id}_table.php"));

            // Delete the model file if it exists
            if (File::exists($modelPath)) {
                File::delete($modelPath);

                // Debug: Confirm model file deletion
                // dd("Model file {$modelPath} deleted.");
            }

            // Delete migration files if they exist
            foreach ($migrationFiles as $migrationFile) {
                if (File::exists($migrationFile)) {
                    File::delete($migrationFile);
                    // Debug: Confirm migration file deletion
                    // dd("Migration file {$migrationFile} deleted.");
                }
            }

            // JSON response to send to the frontend
            return response()->json([
                'message' => 'Data collection deleted successfully.',
                'status' => 'success'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            return response()->json([
                'message' => 'Validation failed',
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $throwable) {
            // General error handling
            return response()->json([
                'message' => 'An error occurred: ' . $throwable->getMessage(),
                'status' => 'error',
                'errors' => [$throwable->getMessage()],
            ], 500);
        }
    }
}
