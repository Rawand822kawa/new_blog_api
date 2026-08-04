<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\RegisterUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Auth\LoginUser;
use App\Actions\Auth\LogoutUser;

class AuthController extends Controller
{
    public function register(Request $request, RegisterUser $registerUser)
    {
        // Validate the data sent by the user
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create a new user
        $user = $registerUser->execute([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
]);

        // Return a JSON response
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }
    public function login(Request $request, LoginUser $loginUser)
{
    // Check that email and password were provided
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $result = $loginUser->execute(
    $request->only('email', 'password')
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