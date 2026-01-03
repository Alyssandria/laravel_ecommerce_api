<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OauthRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Laravel\Socialite\Socialite;


class AuthController extends Controller
{
    public function OauthCallback(OauthRequest $request, AuthService $auth) {
        return $auth->oauth(collect($request->validated()));
    }
    public function Login(LoginRequest $request, AuthService $auth) {
        return $auth->login(collect($request->validated()));
    }

    public function register(RegisterRequest $request, AuthService $auth){
        return $auth->register(collect($request->validated()));
    }

    public function logout(Request $request, AuthService $auth){
        return $auth->logout($request->user());
    }
}
