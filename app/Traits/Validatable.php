<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait Validatable
{
    protected array $validationErrors = [];

    /**
     * @throws ValidationException
     */
    public function validateData(array $data): array
    {
        $validator = Validator::make($data, $this->validationRules(), $this->validationMessages(), $this->validationAttributes());

        $results = [];

        if ($this->validationEmitThrow()) {
            $results = $validator->validate();
        } else {
            if ($validator->fails()) {
                $this->validationErrors = $validator->errors()->all();

                $this->validationFails();
            }
        }

        return $results;
    }

    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }

    protected function validationAttributes(): array
    {
        return [];
    }

    protected function validationRules(): array
    {
        return [];
    }

    protected function validationMessages(): array
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
}
