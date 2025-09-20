<?php

namespace App\DTO\Users;

use App\DTO\BaseDTO;
use Illuminate\Validation\ValidationException;

class UpdateUsernameDTO extends BaseDTO
{
    protected string|null $username = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->username = $data['username'];
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    protected function rules(): array
    {
        return [
            'username' => ['required', 'string'],
        ];
    }
}
