<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Actions\ApiAction;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Actions\Categories\Create as CreateCategory;
use App\Modules\Enotes\DTO\Categories\CreateCategoryDTO;
use App\Modules\Enotes\DTO\Sections\SectionDTO;
use App\Modules\Enotes\Models\Section;
use Illuminate\Validation\ValidationException;

abstract class SectionAction extends ApiAction
{
    protected Workspace|null $workspace;

    protected Section|null $section;

    /**
     * @throws ValidationException
     */
    protected function getCategory(SectionDTO $dto): ?Section
    {
        $category = null;

        if ($dto->getCategoryId()) {
            $category = $dto->getCategory();
        } elseif ($dto->getCategoryName()) {
            $createCategory = new CreateCategory();

            $createCategory->execute($this->workspace, new CreateCategoryDTO([
                'name' => $dto->getCategoryName(),
            ]));

            $category = $createCategory->getCategory();
        }

        return $category;
    }
}
