<?php

namespace App\Actions\Auth;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginUser{

  public function execute(array $data){

    if(!Auth::attempt($data)){
      throw ValidationException::withMessages([
        'email'=>['The provided credentials are incorrect.']
      ]);
    }

    $user = Auth::user();
    $token = $user->createToken('api-token')->plainTextToken;

    return [
        'user' => $user,
        'token' => $token,
    ];

  }

}