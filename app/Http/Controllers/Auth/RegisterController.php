<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Auth\UserRepositoryInterface;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryInterface $interface)
    {
        $this->user = $interface;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->user->createUser($request->all());
        if ($user) {
            return response()->json([
                'message' => 'Registration successful. Please login',
                'user' => $user,
            ], 201);
        }        
    }
}
