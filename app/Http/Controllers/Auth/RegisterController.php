<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    protected $user;
    public function __construct()
    {

    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return response()->json([
            'message' => 'Registration successful. Please login',
            'user' => $user,
        ], 201);
    }
}
