<?php

namespace App\Actions\Users;

use App\Actions\ApiAction;
use App\DTO\Users\UpdateAppearanceDTO;
use App\Http\Resources\User\UpdateAppearanceResource;
use App\Models\User\User;
use App\Models\User\UserSettings;

class UpdateAppearance extends ApiAction
{
    protected User $user;

    private UserSettings|null $settings = null;

    protected bool $notify = true;

    public function execute(User $user, UpdateAppearanceDTO $dto): bool
    {
        $this->user = $user;

        $this->settings = $this->user->settings->first();

        $this->settings->appearance_mode = $dto->getAppearanceMode();
        $this->settings->appearance_color = $dto->getAppearanceColor();

        $this->settings->save();

        return true;
    }

    protected function summary(): string
    {
        return __('alert.account.update_appearance_success');
    }

    protected function resource(): UpdateAppearanceResource
    {
        return new UpdateAppearanceResource($this->settings);
    }
}
