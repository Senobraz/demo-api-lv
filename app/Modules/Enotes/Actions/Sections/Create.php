<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Helpers\SortHelper;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\DTO\Sections\CreateSectionDTO;
use App\Modules\Enotes\Http\Resources\Sections\GetSectionResource;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Create extends SectionAction
{
    /**
     * @throws ValidationException
     */
    public function execute(Workspace $workspace, CreateSectionDTO $dto)
    {
        $this->workspace = $workspace;

        $this->validate([]);

        $category = $this->getCategory($dto);

        $this->section = Section::create([
            'workspace_id' => $this->workspace->getId(),
            'parent_id' => $category?->getId(),
            'level' => $category ? $category->getLevel() + 1 : 0,
            'name' => $dto->getName(),
            'type' => $dto->getType(),
            'icon_id' => $dto->getIconId(),
            'sort' => SortHelper::getSortValue(),
        ]);
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('create', [Section::class, $this->workspace])) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): GetSectionResource
    {
        return new GetSectionResource($this->section);
    }
}
