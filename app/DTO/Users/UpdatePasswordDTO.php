<?php

namespace App\DTO\Users;

use App\DTO\BaseDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class UpdatePasswordDTO extends BaseDTO
{
    protected string|null $password = null;

    protected string|null $currentPassword = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->currentPassword = $data['password_current'];
        $this->password = $data['password'];
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getPasswordHash(): string
    {
        return Hash::make($this->password);
    }

    protected function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_current' => ['required', 'string'],
        ];
    }
}
