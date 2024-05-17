<?php

namespace App\Http\Controllers\API\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function logout(Request $request)
    {
        // Revoke the current user's token
    //     $request->user()->currentAccessToken()->delete();

    //     // Respond with a success message
    //     return response()->json([
    //         'message' => 'Logout successful',
    //         'status' => 'success'
    //     ]);
    //
  }
}
