<?php

namespace App\Modules\Enotes\Actions\Notes;

use App\Actions\ApiAction;
use App\Helpers\SortHelper;
use App\Modules\Enotes\DTO\Notes\UpdateSectionDTO;
use App\Modules\Enotes\Http\Resources\Notes\UpdateSectionResource;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class UpdateSection extends ApiAction
{
    protected Note|null $note = null;

    /**
     * @throws ValidationException
     */
    public function execute(Note $note, UpdateSectionDTO $dto)
    {
        $this->note = $note;

        $this->validate([]);

        $this->note->section_id = $dto->getSectionId();
        $this->note->sort = SortHelper::getSortValue();

        $this->note->save();
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('update', $this->note)) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): UpdateSectionResource
    {
        $this->note->refresh();

        return new UpdateSectionResource($this->note);
    }
}
