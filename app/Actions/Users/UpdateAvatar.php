<?php

namespace App\Actions\Users;

use App\Actions\ApiAction;
use App\DTO\Users\UpdateAvatarDTO;
use App\Http\Resources\User\UpdateAvatarResource;
use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UpdateAvatar extends ApiAction
{
    protected User $user;

    protected bool $notify = true;

    public function execute(User $user, UpdateAvatarDTO $dto): bool
    {
        $this->user = $user;

        $profile = $user->profile;

        if (!$profile) {
            abort(404, 'Wrong profile');
        }

        $profile->avatar_color = $dto->getAvatarColor();
        $profile->avatar_icon_id = $dto->getAvatarIconId();

        $profile->save();

        return true;
    }

    protected function summary(): string
    {
        return __('alert.user.update_avatar_success');
    }

    protected function resource(): ResourceCollection|JsonResource|array|null
    {
        $this->user->refresh();

        return new UpdateAvatarResource($this->user);
    }
}
