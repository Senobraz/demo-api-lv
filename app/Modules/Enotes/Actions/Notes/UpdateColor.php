<?php

namespace App\Modules\Enotes\Actions\Notes;

use App\Actions\ApiAction;
use App\Modules\Enotes\DTO\Notes\UpdateColorDTO;
use App\Modules\Enotes\Http\Resources\Notes\UpdateColorResource;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class UpdateColor extends ApiAction
{
    protected Note|null $note = null;

    /**
     * @throws ValidationException
     */
    public function execute(Note $note, UpdateColorDTO $dto)
    {
        $this->note = $note;

        $this->validate([]);

        $this->note->color_id = $dto->getColorId();

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

    protected function resource(): UpdateColorResource
    {
        $this->note->refresh();

        return new UpdateColorResource($this->note);
    }
}
