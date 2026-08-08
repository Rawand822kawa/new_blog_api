<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUser
{
    public function execute(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}