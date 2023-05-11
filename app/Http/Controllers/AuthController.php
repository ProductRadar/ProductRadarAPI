<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request){

        $post_data = $request->validate([
            'username'=>'required|unique:users|string',
            'password'=>'required|string'
        ]);

        $user = User::create([
            'username' => $post_data['username'],
            'password' => Hash::make($post_data['password']),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request){
        if (!\Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'message' => 'Login information is invalid.'
            ], 401);
        }

        $user = User::where('username', $request['username'])->firstOrFail();

        // get current time and add an hour
        $expirationsDate = Carbon::now()->addHour();

        // create a token
        $token = $user->createToken('authToken', ['*'], $expirationsDate)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
