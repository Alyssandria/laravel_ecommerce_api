<?php

namespace App\Services;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Collection;

class AddressService {
    public function create(User $user, Collection $data) {
        $address = $user->addresses()->create([
            'recipient_name' => $data->get('recipient_name'),
            'phone' => $data->get('phone'),
            'email' => $data->get('email'),
            'city' => $data->get('city'),
            'province' => $data->get('province'),
            'street' => $data->get('street'),
            'label' => $data->get('label'),
        ]);

        return response()->json([
            'success' => true,
            'message' => "Address successfully created",
            'data' => $address->toResource()
        ]);
    }

    public function update(Address $address, Array $data) {
        $updated = $address->update($data);

        if(!$updated){
            return response()->noContent();
        }

        return response()->json([
            'success' => true,
            'message' => "Address successfully updated",
            'data' => $address->toResource()
        ]);
    }

    public function delete(User $user, Address $address) {
        Address::where(['user_id' => $user->id, 'id' => $address->id])
            ->delete();
        return response()->noContent();
    }

    public function all(User $user) {
        return response()->json([
            'success' => true,
            'message' => "All address fetched successfully",
            'data' => $user->addresses()->get()->toResourceCollection()
        ]);
    }

    public function get(Address $address){
        return response()->json([
            'success' => true,
            'message' => "Address successfully fetched",
            'data' => $address->toResource()
        ]);
    }
}
