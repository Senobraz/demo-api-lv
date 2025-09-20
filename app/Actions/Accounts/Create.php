<?php

namespace App\Actions\Accounts;

use App\Actions\ApiAction;
use App\DTO\Accounts\CreateAccountDTO;
use App\Events\AccountCreated;
use App\Models\Account\Account;
use App\Models\Account\AccountSettings;
use App\Models\Module\Module;
use App\Models\User\User;
use App\Models\User\UserAccount;
use App\Models\User\UserProfile;
use App\Models\User\UserSettings;
use App\Supports\ModuleSupport;
use App\Supports\UserSupport;
use App\Traits\UseDB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Create extends ApiAction
{
    use UseDB;

    public function execute(CreateAccountDTO $dto): void
    {
        $this->validate([]);

        $this->transaction(function () use ($dto): void {
            $user = User::create([
                'name' => $dto->getName(),
                'email' => $dto->getEmail(),
                'password' => $dto->getPasswordHash(),
            ]);

            $account = Account::create([
                'active' => true,
                'status' => Account::STATUS_DEFAULT,
                'reg_ip' => $dto->getIp(),
                'reg_host' => $dto->getHost(),
                'reg_domain' => $dto->getDomain(),
            ]);

            AccountSettings::create([
                'account_id' => $account->getId(),
            ]);

            UserProfile::create([
                'user_id' => $user->getId(),
                'avatar_default_color' => UserSupport::getGenerateAvatarColor($user),
            ]);

            UserSettings::create([
                'user_id' => $user->getId(),
                'timezone' => $dto->getTimezone(),
                'language_id' => $dto->getLanguageId(),
                'date_format' => $dto->getDateFormat(),
                'time_format' => $dto->getTimeFormat(),
                'week_start' => $dto->getWeekStart(),
                'appearance_mode' => $dto->getAppearanceMode(),
                'appearance_theme' => $dto->getAppearanceTheme(),
                'appearance_color' => $dto->getAppearanceColor(),
            ]);

            UserAccount::create([
                'user_id' => $user->getId(),
                'account_id' => $account->getId(),
            ]);

            ModuleSupport::install($account, Module::MODULE_ENOTE);

            event(new Registered($user));

            Auth::login($user);

            event(new AccountCreated(Auth::user()));
        });
    }

    public function validate(array $data): bool
    {
        if (App::environment('staging')) {
            throw ValidationException::withMessages([
                'forbidden' => __('alert.account.registration_disallow'),
            ]);
        }

        return parent::validate($data);
    }
}
