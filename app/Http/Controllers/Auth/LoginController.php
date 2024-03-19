<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Incorrect Email'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Incorrect Password'
            ], 401);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('user-token')->plainTextToken,
            'message' => 'Login Successful',
        ], 200);

    }
}
