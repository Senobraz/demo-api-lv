<?php

namespace App\Modules\Enotes\Actions\Categories;

use App\Actions\ApiAction;
use App\Helpers\SortHelper;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\DTO\Categories\CreateCategoryDTO;
use App\Modules\Enotes\Http\Resources\Sections\CategoryResource;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Create extends ApiAction
{
    protected Workspace|null $workspace;

    protected Section $section;

    /**
     * @throws ValidationException
     */
    public function execute(Workspace $workspace, CreateCategoryDTO $dto)
    {
        $this->workspace = $workspace;

        $this->validate([]);

        $this->section = Section::create([
            'workspace_id' => $this->workspace->getId(),
            'name' => $dto->getName(),
            'type' => $dto->getType(),
            'sort' => SortHelper::getSortValue(),
        ]);
    }

    public function validate(array $data): bool
    {
        if (!$this->workspace || !Gate::check('create', [Section::class, $this->workspace])) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    public function getCategory(): Section
    {
        return $this->section;
    }

    protected function resource(): CategoryResource
    {
        return new CategoryResource($this->section);
    }
}
