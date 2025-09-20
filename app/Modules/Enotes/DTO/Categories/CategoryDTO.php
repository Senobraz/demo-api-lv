<?php

namespace App\Modules\Enotes\DTO\Categories;

use App\DTO\BaseDTO;
use App\Modules\Enotes\Models\Section;
use Illuminate\Validation\ValidationException;

class CategoryDTO extends BaseDTO
{
    protected string|null $name = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->name = $data['name'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): int
    {
        return Section::TYPE_CATEGORY;
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
