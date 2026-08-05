<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginUser;
use App\Actions\Auth\LogoutUser;
use App\Actions\Auth\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterUser $registerUser)
    {
        // Validate the data sent by the user
        
        // Create a new user
        $user = $registerUser->execute([
        $request->validated()
]);

        // Return a JSON response
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }
    public function login(LoginRequest $request, LoginUser $loginUser)
{
    // Check that email and password were provided
    

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