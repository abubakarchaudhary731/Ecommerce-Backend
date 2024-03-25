<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserPaymentDetail;
use Illuminate\Support\Facades\Hash;

class UserDetailRepository implements UserDetailRepositoryInterface
{
    /* ***************** Store User Address Function ************************ */
    public function createUserAddress($request)
    {
        $userAdress = UserAddress::create([
            'user_id' => auth()->user()->id,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->area,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
        ]);

        return $userAdress;

    }
    /* ***************** Update User Address Function ************************ */
    public function updateUserAddress($id, $request)
    {
        $userAdress = UserAddress::find($id);
        $userAdress->update([
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->area,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
        ]);

        return $userAdress;

    }

    /* ***************** Delete User Address Function ************************ */
    public function deleteUserAddress($id)
    {
        $userAdress = UserAddress::find($id);
        if ($userAdress) {
            $userAdress->delete();
            return response()->json([
                'message' => 'Address deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'Address not found',
        ]);

    }

    /* ***************** Create User Payment Detail Function ************************ */
    public function createUserPaymentDetail($request)
    {
        $userPaymentDetail = UserPaymentDetail::create([
            'user_id' => auth()->user()->id,
            'payment_method' => 'card',
            'name_on_card' => $request->name_on_card,
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
        ]);

        return $userPaymentDetail;
    }

    /* ***************** Update User Payment Detail Function ************************ */
    public function updateUserPaymentDetail($id, $request)
    {
        $userPaymentDetail = UserPaymentDetail::find($id);
        if ($userPaymentDetail) {
            $userPaymentDetail->update([
                'name_on_card' => $request->name_on_card,
                'card_number' => $request->card_number,
                'expiry_date' => $request->expiry_date,
            ]);
            return response()->json([
                'message' => 'Your Payment Information Updated successfully',
                'data' => $userPaymentDetail,
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to Update User payment detail'
            ], 500);
        }
    }

    /* ***************** Delete User Payment Detail Function ************************ */
    public function deleteUserPaymentDetail($id)
    {
        $userPaymentDetail = UserPaymentDetail::find($id);
        if ($userPaymentDetail) {
            $userPaymentDetail->delete();
            return response()->json([
                'message' => 'Payment Detail deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'Payment Detail not found',
        ]);

    }


}
