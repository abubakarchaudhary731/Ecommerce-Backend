<?php

namespace App\Repositories\Auth;

interface UserDetailRepositoryInterface
{
    public function createUserAddress($request);
    public function updateUserAddress($id, $request);
    public function deleteUserAddress($id);

    public function createUserPaymentDetail($request);
    public function updateUserPaymentDetail($id, $request);
    public function deleteUserPaymentDetail($id);
}