<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Models\User;

class LogoutUser
{
    public function execute(User $user)
    {
        $user->user()->currentAccessToken()->delete();

        return;
    }
}