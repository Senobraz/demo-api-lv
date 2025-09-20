<?php

namespace App\DTO;

use App\Traits\UseVariableCache;
use App\Traits\Validatable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BaseDTO
{
    use Validatable, UseVariableCache;

    public function __construct(?array $data = null)
    {

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

    public function toArray(): array
    {
        return [];
    }

    public function toJson(): array
    {
        return [];
    }

    /**
     * @throws ValidationException
     */
    protected function prepare(&$data): void
    {
        $data = $this->validated($data);
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

    protected function validationEmitThrow(): bool
    {
        return true;
    }

    protected function validationFails(): void
    {

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

    static public function fromRequest(Request $request): static
    {
        return new static(array_merge($request->all(), [
            'ip' => $request->ip(),
        ]));
    }
}
