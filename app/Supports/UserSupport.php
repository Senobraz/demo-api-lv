<?php

namespace App\Supports;

use App\Models\Account\Account;
use App\Models\Dictionaries\DictionaryColor;
use App\Models\User\User;
use App\Models\User\UserSettings;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserSupport
{
    static public function getGenerateAvatarColor(?User $user = null): ?string
    {
        $user = $user ?? self::getUser();

        if(!$user) {
            return null;
        }

        $colors = DictionaryColor::ofPackage(DictionaryColor::PACKAGE_AVATARS)->pluck('value')->toArray();

        return count($colors) > 0 ? $colors[$user->getId() % count($colors)] : null;
    }

    static public function getLocalizationCode(?User $user = null): ?string
    {
        $user = $user ?? self::getUser();

        return $user?->settings->first()->getLanguageCode();

    }

    static public function getUser(): User|\Illuminate\Contracts\Auth\Authenticatable|null
    {
        return Auth::user();
    }

    static public function getId(): ?int
    {
        return !self::getUser() ? null : self::getUser()->getId();
    }

    static public function getAccounts(?User $user = null): ?Account
    {
        $user = $user ?? self::getUser();

        return $user
            ?->accounts
            ->where('active', 1)
            ->first();
    }

    static public function existsAccount(?User $user = null): bool
    {
        $account = self::getAccount($user);

        if(!$account) {
            return false;
        }

        return true;
    }

    static public function getAccount(?User $user = null): ?Account
    {
        $user = $user ?? self::getUser();

        return $user?->accounts->first();
    }

    static public function getAccountId(?User $user = null): int
    {
        return self::getAccount($user)->getId();
    }

    static public function getAccountSettings(?User $user = null): ?UserSettings
    {
        $user = $user ?? self::getUser();

        return $user?->settings->first();
    }

    static public function getWorkspaces(?User $user = null): Collection
    {
        $user = $user ?? self::getUser();

        return $user?->workspaces;
    }

}
