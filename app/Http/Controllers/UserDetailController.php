<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PaymentDetailRequest;
use App\Http\Requests\Auth\UserAddressRequest;
use App\Repositories\Auth\UserDetailRepositoryInterface;

class UserDetailController extends Controller
{
    protected $address;
    public function __construct(UserDetailRepositoryInterface $interface)
    {
        $this->address = $interface;
    }
    
    public function addressStore(UserAddressRequest $request)
    {

        $userAdress = $this->address->createUserAddress($request);
        return response()->json([
            'message' => 'Address added successfully',
            'data' => $userAdress,
        ]);
    }

    public function addressUpdate($id, UserAddressRequest $request)
    {
        $userAdress = $this->address->updateUserAddress($id, $request);
        return response()->json([
            'message' => 'Address updated successfully',
            'data' => $userAdress,
        ]);
    }

    public function addressDelete($id)
    {
        return $this->address->deleteUserAddress($id);
    }

    public function paymentDetailStore(PaymentDetailRequest $request)
    {
        $userPaymentDetail = $this->address->createUserPaymentDetail($request);
        return response()->json([
            'message' => 'Your Payment Information added successfully',
            'data' => $userPaymentDetail,
        ]);
    }

    public function paymentDetailUpdate($id, PaymentDetailRequest $request)
    {
        return $this->address->updateUserPaymentDetail($id, $request);
    }

    public function paymentDetailDelete($id)
    {
        return $this->address->deleteUserPaymentDetail($id);
    }
}
