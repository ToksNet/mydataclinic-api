<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Organisation;
use App\Http\Controllers\Api\Data;
use App\Http\Controllers\API\Organisation\ForgotPasswordController;
use App\Http\Controllers\API\Organisation\ResetPasswordController;
use App\Http\Controllers\API\Organisation\VerifyPasswordController;
use App\Http\Controllers\API\Organisation\PasswordController; 
use App\Http\Controllers\API\Organisation\DataCollectionPasswordController;
use App\Http\Controllers\API\Organisation\DataCollectionProfileController;
use App\Http\Controllers\Api\Organisation\ChangeEmailController;

// use App\Http\Controllers\API\Organisation\VerificationController;

use App\Http\Controllers\Api\DataCollection;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('organisation')->group(function() {
    
    Route::post('register', [Organisation\RegisterController::class, 'store'])->name('organisation.register.store');
    Route::post('login', [Organisation\LoginController::class, 'store'])->name('organisation.login.store');
    Route::post('logout', [Organisation\LogoutController::class, 'logout'])->name('organisation.logout');
    Route::put('update/{id}', [Organisation\ProfileController::class, 'update'])->name('organisation.update');
    Route::get('verify/{hash}', [Organisation\EmailVerificationController::class, 'store'])->name('organisation.verify');
    Route::post('change-email', [Organisation\ChangeEmailController::class, 'update']); //Newly Added Controller for changing Email
    Route::get('resend/verification/{business_email}', [Organisation\RegisterController::class, 'resend']);
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
    Route::POST('reset-password/{id}', [ResetPasswordController::class, 'reset'])->name('organisation.reset-password');
    Route::get('verify-token/{hash}', [VerifyPasswordController::class, 'store'])->name('organisation.verify-token');
    Route::post('change-password/{id}', [PasswordController::class, 'update'])->name('organisation.change-password');
    
    
    
    Route::post('data/collection/new-collection', [DataCollection\RegisterController::class, 'store']);
    Route::post('change-data-password/{id}', [DataCollection\DataCollectionPasswordController::class, 'update']);
    Route::prefix('data/collections')->group(function(){
        Route::post('import', [Data\ImportController::class, 'store']);
        Route::get('{collection_id}/all', [Data\AllDataController::class, 'index']); 
        Route::post('{collection_id}/filter', [Data\SortDataController::class, 'filter_by_date_range']);
    
    });
    // This is the New route for fetching all data by organization ID
    Route::get('{organisation_id}/all', [DataCollection\AllDataController::class, 'index']);
    
    Route::get('test', function(){
        dd('working');
    });
    
    Route::middleware(['sanctumOrOrganisation'])->group(function () {

    });

    Route::get('test/verify', function (){
        return view('emails.verify_email');
    });
    Route::get('config', function (){
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:cache');
    });
    
});
Route::post('data/collection/sign-in', [DataCollection\LoginController::class, 'store'])->name('data.collection.login');




