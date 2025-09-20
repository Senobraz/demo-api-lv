<?php

namespace App\Actions;

use App\Models\User\User;
use App\Traits\Validatable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

abstract class ApiAction
{
    use Validatable;

    protected bool $notify = false;

    protected int $notifyDelay = 2000;

    public function getResponse(): array|null
    {
        return [
            'status' => true,
            'message' => $this->summary(),
            'notify' => $this->notify(),
            'notify_delay' => $this->notifyDelay(),
            'notify_title' => $this->notifyTitle(),
            'notify_message' => $this->notifyMessage(),
            'resource' => $this->resource(),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validate(array $data): bool
    {
        return (bool)$this->validated($data);
    }

    /**
     * @throws ValidationException
     */
    public function validated(array $data): array
    {
        return $this->validateData($data);
    }

    protected function prepare(array &$data): void
    {

    }

    protected function rules(): array
    {
        return [];
    }

    protected function attributes(): array
    {
        return [];
    }

    protected function messages(): array
    {
        return [];
    }

    protected function resource(): ResourceCollection|JsonResource|array|null
    {
        return [];
    }

    protected function summary(): string
    {
        return '';
    }

    protected function notify(): bool
    {
        return $this->notify;
    }

    protected function notifyTitle(): string
    {
        return '';
    }

    protected function notifyMessage(): string
    {
        return '';
    }

    protected function notifyDelay(): int
    {
        return $this->notifyDelay;
    }

    protected function user(): ?User
    {
        return Auth::user() ?? null;
    }

    private function validationAttributes(): array
    {
        return $this->attributes();
    }

    private function validationMessages(): array
    {
        return $this->messages();
    }

    private function validationRules(): array
    {
        return $this->rules();
    }
}
