<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login (AuthRequest $request) {
        
        $credentials = $request->validated();
        
        if(!Auth::attempt($credentials)) {
            return response()->json([
                "status" => false,
                "message" => "Error Auth"
            ]);
        }

        $user = User::where("email", $request->email)->first();
        return response()->json([
            "status" => true,
            "data" => $user,
            "token" => $user->createToken("API-TOKEN")->plainTextToken
        ]);
    }
}
