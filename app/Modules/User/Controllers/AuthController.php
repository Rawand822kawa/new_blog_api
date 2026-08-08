<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Actions\LoginUser;
use App\Modules\User\Actions\LogoutUser;
use App\Modules\User\Actions\RegisterUser;
use App\Modules\User\Requests\LoginRequest;
use App\Modules\User\Requests\RegisterRequest;
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