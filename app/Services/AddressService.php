<?php

namespace App\Services;

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
}
