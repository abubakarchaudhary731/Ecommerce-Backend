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
        if ($user instanceof User) { // Check if user is an instance of User model
            return response()->json([
                'message' => 'Registration successful. Please login',
                'user' => $user,
            ], 201);
        } else {
            return $user; // If createUser method returns a response directly
        }  
    }
}
