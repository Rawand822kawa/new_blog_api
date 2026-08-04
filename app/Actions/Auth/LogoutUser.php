<?php
namespace App\Actions\Auth;

use App\Models\User;




class LogoutUser{

  public function execute(User $user){
    $user->user()->currentAccessToken()->delete();

    return;
  }

}