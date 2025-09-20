<?php

namespace App\Actions\Users;

use App\Actions\ApiAction;
use App\DTO\Users\UpdateUsernameDTO;
use App\Http\Resources\User\UpdateUsernameResource;
use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UpdateUsername extends ApiAction
{
    protected User $user;

    protected bool $notify = true;

    public function execute(User $user, UpdateUsernameDTO $dto): bool
    {
        $this->user = $user;

        $this->user->name = $dto->getUsername();

        $this->user->save();

        return true;
    }

    protected function rules(): array
    {
        return [
            'username' => ['required', 'string'],
        ];
    }

    protected function summary(): string
    {
        return __('alert.user.update_username_success');
    }

    protected function resource(): ResourceCollection|JsonResource|array|null
    {
        return new UpdateUsernameResource($this->user);
    }
}
