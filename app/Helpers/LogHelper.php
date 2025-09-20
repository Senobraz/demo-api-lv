<?php

namespace App\Helpers;

use App\Models\User\User;

class LogHelper
{
    static public function getUserName(User $user): ?string
    {
        return $user->getUserName() . ' | ' . $user->getEmail() . ' [ID: ' . $user->getId() . ']';
    }
}
