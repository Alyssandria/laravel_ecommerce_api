<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function GetUser(Request $request, UserService $user) {
        return $user->profile($request->user());
    }

    public function PatchUser(UserProfileRequest $request, UserService $user) {
        return $user->editProfile($request->user(), $request->validated());
    }
}
