<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the data sent by the user
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return a JSON response
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }
    public function login(Request $request)
{
    // Check that email and password were provided
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Check if the email and password are correct
    if (!Auth::attempt($request->only('email', 'password'))) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Get the logged-in user
    $user = Auth::user();

    // Create a Sanctum token
    $token = $user->createToken('api-token')->plainTextToken;

    // Return the token
    return response()->json([
        'message' => 'Login successful!',
        'token' => $token,
    ]);
}
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logged out successfully!'
    ]);
}
}