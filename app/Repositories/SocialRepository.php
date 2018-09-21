<?php

namespace App\Repositories;

use App\Models\SocialiteUser;
use App\User;

class SocialRepository
{

    public function GetProviderUser($providerUserId)
    {

        $socialiteUser = SocialiteUser::whereProvider('facebook')->whereProviderUserId($providerUserId)->first();
        return $socialiteUser;

    }

    public function GetUser($providerUserEmail)
    {

        $user = User::whereEmail($providerUserEmail)->first();
        return $user;
    }

    public function CreateUser($providerUserEmail, $providerUserName)
    {

        $user = User::create(
            [
                'email' => $providerUserEmail,
                'name' => $providerUserName,
            ]
        );

        return $user;
    }

}