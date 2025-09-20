<?php

namespace App\Modules\Enotes\DTO\Collaborative;

use App\DTO\BaseDTO;
use App\Modules\Enotes\Models\NoteCollaborative;
use Illuminate\Validation\ValidationException;

class PublicNoteDTO extends BaseDTO
{
    protected string|null $key = null;

    protected string|null $code = null;

    protected string|null $ip = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->key = $data['key'] ?? null;
        $this->code = $data['code'] ?? null;
        $this->ip = $data['ip'] ?? null;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    protected function rules(): array
    {
        return [
            'key' => ['required', 'ulid'],
            'code' => ['nullable', 'string', 'min:16', 'max:16'],
            'ip' => ['required', 'string', 'max:45', 'ip'],
        ];
    }
}
