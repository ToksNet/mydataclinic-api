<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthSanctumOrOrganisation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('organisation')->check()){
            return $next($request);

        }elseif(Auth::guard('sanctum')->check()){

            return $next($request);
        }

        $response = collect([
            'message' => 'Restricted area! Not for unauthorized persons',
            'status' => 'error',
            'errors' =>['Unauthorized! Invalid Authentication token.'],
        ]);
        return response()->json($response, 401);
        
    }
}
