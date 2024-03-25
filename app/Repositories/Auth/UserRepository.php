<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /* ***************** Register User Function ************************ */
    public function createUser($data)
    {
        // $user = new User();
        // $user->name = $data['name'];
        // $user->email = $data['email'];
        // $user->password = Hash::make($data['password']);
        // $user->phone = $data['phone'] ?? null;
        // $user->address = $data['address'] ?? null;
        // $user->save();
        // return $user;
        return User::create($data);
    }
     /* ***************** Login User Function ************************ */
    public function login($request)
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

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }



    public function updateUser($id, $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'User not found',
        ]);
    }

    // Add more methods as needed...
}
