<?php

namespace App\Services;

use App\Models\User;

class UserService {
    public function profile(User $user) {
        return $user->toResource();
    }

    public function editProfile(User $user, Array $credentials) {

        $user->update($credentials);

        return response()->json([
            'success' => true,
            'message' => "Profile succesfully updated",
            'data' => $user
        ]);
    }
}
