<?php

namespace Modules\User\HTTP\Controllers;

use Modules\User\Actions\LoginUser;
use Modules\User\Actions\LogoutUser;
use Modules\User\Actions\RegisterUser;
use Modules\User\Requests\LoginRequest;
use Modules\User\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController
{
    public function register(RegisterRequest $request, RegisterUser $registerUser)
    {
        $user = $registerUser->execute(
            $request->validated()
        );

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }


    public function login(LoginRequest $request, LoginUser $loginUser)
    {
        $result = $loginUser->execute(
            $request->validated()
        );

        return response()->json([
            'message' => 'Login successful!',
            'token' => $result['token'],
        ]);
    }


    public function logout(Request $request, LogoutUser $logoutUser)
    {
        $logoutUser->execute($request->user());

        return response()->json([
            'message' => 'Logged out successfully!'
        ]);
    }
}
