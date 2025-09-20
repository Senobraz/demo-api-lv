<?php

namespace App\Actions\Users;

use App\Actions\ApiAction;
use App\DTO\Users\UpdatePasswordDTO;
use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdatePassword extends ApiAction
{
    protected User $user;

    protected bool $notify = true;

    /**
     * @throws ValidationException
     */
    public function execute(User $user, UpdatePasswordDTO $dto): bool
    {
        $this->user = $user;

        $this->validate([
            'password_current' => $dto->getCurrentPassword(),
        ]);

        $user->forceFill([
            'password' => $dto->getPasswordHash(),
        ])->save();

        return true;
    }

    public function validate(array $data): bool
    {
        if (!Hash::check($data['password_current'], $this->user->password)) {
            throw ValidationException::withMessages([
                'password' => __('validation.current_password_alt'),
            ]);
        }

        return parent::validate($data);
    }

    protected function summary(): string
    {
        return __('alert.user.update_password_success');
    }

    protected function resource(): ResourceCollection|JsonResource|array|null
    {
        return null;
    }
}
