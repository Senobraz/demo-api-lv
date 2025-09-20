<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Modules\Enotes\DTO\Sections\UpdateMoveDTO;
use App\Modules\Enotes\Http\Resources\Sections\UpdateMoveCollection;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class UpdateMove extends SectionSortableAction
{
    protected Section|null $parentSection = null;

    /**
     * @throws ValidationException
     */
    public function execute(Section $section, UpdateMoveDTO $dto)
    {
        $this->section = $section;

        $this->parentSection = $dto->getParentUlid() ? Section::getByUlid($dto->getParentUlid()) : null;

        $this->validate();

        $this->section->parent_id = $this->parentSection?->getId();

        if ($this->section->isDirty()) {
            $this->section->save();
        }

        $this->updateSortableValues($dto);
    }

    public function validate(array $data = []): bool
    {
        if (
            $this->parentSection &&
            $this->parentSection->getWorkspaceId() !== $this->section->getWorkspaceId()
        ) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        if (!Gate::check('move', $this->section)) {
            throw ValidationException::withMessages([
                'forbidden' => 'the operation is not available',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): UpdateMoveCollection
    {
        return new UpdateMoveCollection($this->sections);
    }
}
