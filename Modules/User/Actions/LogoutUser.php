<?php

namespace Modules\User\Actions;

use Modules\User\Models\User;

class LogoutUser
{
    public function execute(User $user)
    {
        $user->user()->currentAccessToken()->delete();

        return;
    }
}