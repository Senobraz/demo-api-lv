<?php

namespace App\DTO\Dictionaries;

use App\Contracts\DictionaryContract;
use App\DTO\BaseDTO;
use Illuminate\Validation\ValidationException;

class DictionaryDTO extends BaseDTO implements DictionaryContract
{
    protected string|null $ulid = null;

    protected string $label = '';

    protected string|int|null $value = null;

    protected string|int|null $alt_value = null;

    protected string|null $package = null;

    protected int $sort = 500;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->label = $data['label'] ?? null;
        $this->value = $data['value'] ?? null;
        $this->alt_value = $data['alt_value'] ?? null;
        $this->package = $data['package'] ?? null;
        $this->sort = $data['sort'] ?? $this->sort;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): string|int|null
    {
        return $this->value;
    }

    public function getAltValue(): string|int|null
    {
        return $this->alt_value;
    }

    public function getPackage(): ?string
    {
        return $this->package;
    }

    public function getSort(): int
    {
        return (int)$this->sort;
    }

    public function getUlid(): ?string
    {
        return $this->ulid;
    }

    protected function rules(): array
    {
        return [
            'label' => ['required', 'string'],
            'value' => ['required'],
            'alt_value' => ['nullable'],
            'package' => ['nullable', 'string'],
            'sort' => ['nullable', 'string'],
        ];
    }
}
