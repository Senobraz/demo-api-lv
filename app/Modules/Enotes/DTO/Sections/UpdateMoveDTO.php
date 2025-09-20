<?php

namespace App\Modules\Enotes\DTO\Sections;

use App\DTO\BaseDTO;
use App\Modules\Enotes\Contracts\SortableItemsContract;
use App\Modules\Enotes\Models\Section;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateMoveDTO extends BaseDTO implements SortableItemsContract
{
    protected string|null $beforeUlid = null;

    protected string|null $afterUlid = null;

    protected string|null $parentUlid = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->beforeUlid = $data['before_id'] ?? null;
        $this->afterUlid = $data['after_id'] ?? null;
        $this->parentUlid = $data['parent_id'] ?? null;
    }

    public function getBeforeUlid(): ?string
    {
        return $this->beforeUlid;
    }

    public function getAfterUlid(): ?string
    {
        return $this->afterUlid;
    }

    public function getParentUlid(): ?string
    {
        return $this->parentUlid;
    }

    protected function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'ulid', Rule::exists(Section::class, 'ulid')],
            'before_id' => ['nullable', 'ulid', Rule::exists(Section::class, 'ulid')],
            'after_id' => ['nullable', 'ulid', Rule::exists(Section::class, 'ulid')],
        ];
    }
}
