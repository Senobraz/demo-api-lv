<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Modules\Enotes\DTO\Sections\UpdateOrderDTO;
use App\Modules\Enotes\Http\Resources\Sections\UpdateOrderResource;
use App\Modules\Enotes\Models\Section;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class UpdateOrder extends SectionSortableAction
{
    protected array|Collection $sections = [];

    /**
     * @throws ValidationException
     */
    public function execute(Section $section, UpdateOrderDTO $dto)
    {
        $this->section = $section;

        $this->validate([]);

        $this->updateSortableValues($dto);
    }

    public function validate(array $data = []): bool
    {
        if (!Gate::check('order', $this->section)) {
            throw ValidationException::withMessages([
                'forbidden' => 'the operation is not available',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): UpdateOrderResource
    {
        return new UpdateOrderResource($this->section);
    }
}
