<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Auth\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }
    
    public function login(Request $request)
    {
        return $this->user->login($request);
    }
}
