<?php

namespace App\Modules\Enotes\Actions\Notes;

use App\Actions\ApiAction;
use App\Modules\Enotes\DTO\Notes\UpdateNoteDTO;
use App\Modules\Enotes\Http\Resources\Notes\UpdateResource;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Update extends ApiAction
{
    protected Note|null $note = null;

    /**
     * @throws ValidationException
     */
    public function execute(Note $note, UpdateNoteDTO $dto)
    {
        $this->note = $note;

        $this->validate([]);

        $this->note->title = $dto->getTitle();
        $this->note->heading = $dto->getHeadingJson();
        $this->note->preview = $dto->getPreviewJson();
        $this->note->content = $dto->getContentJson();
        $this->note->updated_content_at = Date::now();

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

    protected function resource(): UpdateResource
    {
        $this->note->refresh();

        return new UpdateResource($this->note);
    }
}
