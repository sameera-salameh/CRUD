<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Authenticate the user and issue an API token.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email' , $credentials['email'])->first();

        if ($user->is_block == 1 ){
            return response()->json(['message' => 'User is blocked'] ,403);
        }

        if(!$user || !Hash::check($credentials['password'] , $user->password))
        {return response()->json(['message' => 'error in email or password'] , 401);}

            $token = $user->createToken($user->name.'authToken')->plainTextToken;
            return response()->json(['token' => $token] , 200);
        }


    /**
     * Log out the authenticated user and revoke the API token.
     */
    public function logout(Request $request)
    {

        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}

