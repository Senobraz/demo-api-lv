<?php

namespace App\Modules\Enotes\Actions\Share\Notes;

use App\Actions\ApiAction;
use App\Modules\Enotes\Http\Resources\Share\Notes\GetPublicResource;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\NoteCollaborative;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class PublicDisable extends ApiAction
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

        $this->noteCollaborative->public_active = false;
        $this->noteCollaborative->save();

        $this->note->shared = false;
        $this->note->save();
    }

    public function validate(array $data): bool
    {
        if(!$this->noteCollaborative) {
            throw ValidationException::withMessages([
                'forbidden' => 'an unavailable resource',
            ]);
        }

        if (!Gate::check('sharePublicEnable', $this->note)) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): GetPublicResource
    {
        return new GetPublicResource($this->noteCollaborative);
    }
}
