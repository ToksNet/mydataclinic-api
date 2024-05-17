<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Resources\DataCollection;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'collection_name' => ['bail', 'required', 'string', 'max:255'],
            'collection_description' => ['bail', 'required', 'string'],
            'collection_slug' => ['bail', 'required', 'string', 'max:255'],
            'collection_email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['bail', 'required', 'confirmed', Rules\Password::defaults()],
        ]);


        $userId = Auth::guard('organisation')->user()->id;
        $editedCollectionName = str_replace(' ', '_', $request->collection_name);
        $editedCollectionName = str_replace('-', '_', $editedCollectionName);
        $collection_slug = $editedCollectionName.'_'.$userId;

        $user = User::create([
            'organisation_id' => $userId,
            'collection_name' => $request->name,
            'collection_email' => $request->email,
            'collection_description' => $request->name,
            'collection_slug' => $collection_slug,
            'password' => Hash::make($request->password),
        ]);

        return new DataCollection($user);
    }
}
