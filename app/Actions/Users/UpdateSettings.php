<?php

namespace App\Actions\Users;

use App\Actions\ApiAction;
use App\DTO\Users\UpdateSettingsDTO;
use App\Http\Resources\User\UpdateBasicSettingsResource;
use App\Models\User\User;
use App\Models\User\UserSettings;
use Illuminate\Support\Facades\Log;

class UpdateSettings extends ApiAction
{
    protected User $user;

    private UserSettings|null $settings = null;

    protected bool $notify = true;

    public function execute(User $user, UpdateSettingsDTO $dto): bool
    {
        $this->user = $user;

        $this->settings = $this->user->settings->first();

        $this->settings->update($dto->toArray());

        if ($this->settings->wasChanged('language_id')) {
            $this->notify = false;
        }

        return true;
    }

    protected function summary(): string
    {
        return __('alert.account.update_basic_success');
    }

    protected function resource(): UpdateBasicSettingsResource
    {
        return new UpdateBasicSettingsResource($this->settings);
    }
}
