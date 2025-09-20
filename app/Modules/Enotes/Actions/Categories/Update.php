<?php

namespace App\Modules\Enotes\Actions\Categories;

use App\Actions\ApiAction;
use App\Modules\Enotes\DTO\Categories\UpdateCategoryDTO;
use App\Modules\Enotes\Http\Resources\Sections\CategoryResource;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Update extends ApiAction
{
    protected Section $section;

    /**
     * @throws ValidationException
     */
    public function execute(Section $section, UpdateCategoryDTO $dto)
    {
        $this->section = $section;

        $this->validate([]);

        $this->section->name = $dto->getName();

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

    protected function resource(): CategoryResource
    {
        return new CategoryResource($this->section);
    }
}
