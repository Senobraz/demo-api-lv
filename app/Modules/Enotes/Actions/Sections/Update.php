<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Modules\Enotes\DTO\Sections\UpdateSectionDTO;
use App\Modules\Enotes\Http\Resources\Sections\GetSectionResource;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Update extends SectionAction
{
    protected bool $notify = true;

    /**
     * @throws ValidationException
     */
    public function execute(Section $section, UpdateSectionDTO $dto)
    {
        $this->section = $section;
        $this->workspace = $section->workspace;

        $this->validate([]);

        $category = $this->getCategory($dto);

        $this->section->name = $dto->getName();
        $this->section->description = $dto->getDescription();
        $this->section->icon_id = $dto->getIconId();
        $this->section->parent_id = $category?->getId();
        $this->section->level = $category ? $category->getLevel() + 1 : 0;

        $this->section->save();
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('update', $this->section)) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function notifyMessage(): string
    {
        return __('alert.saved');
    }

    protected function resource(): GetSectionResource
    {
        return new GetSectionResource($this->section);
    }
}
