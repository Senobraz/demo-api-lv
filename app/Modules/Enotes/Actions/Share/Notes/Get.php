<?php

namespace App\Modules\Enotes\Actions\Share\Notes;

use App\Actions\ApiAction;
use App\Modules\Enotes\Http\Resources\Share\Notes\NoteResource;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\NoteCollaborative;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Get extends ApiAction
{
    protected Note|null $note = null;

    protected NoteCollaborative|null $noteCollaborative = null;

    /**
     * @throws ValidationException
     */
    public function execute(Note $note)
    {
        $this->note = $note;

        $this->noteCollaborative = NoteCollaborative::query()
            ->where('note_id', $this->note->getId())
            ->where('owner_id', $this->user()->getId())
            ->first();

        $this->validate([]);
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('view', $this->note)) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): NoteResource|array
    {
        return $this->noteCollaborative ? new NoteResource($this->noteCollaborative) : [];
    }
}
