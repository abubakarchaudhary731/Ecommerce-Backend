<?php

namespace App\Repositories\Auth;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function createUser($data);
    public function updateUser($id, $data);
    public function deleteUser($id);
    public function login($request);
}