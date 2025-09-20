<?php

namespace App\Modules\Enotes\Actions\Share\Notes;

use App\Actions\ApiAction;
use App\Helpers\SortHelper;
use App\Helpers\StrHelper;
use App\Modules\Enotes\DTO\Share\NotePublicEnableDTO;
use App\Modules\Enotes\Http\Resources\Share\Notes\GetPublicResource;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\NoteCollaborative;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PublicEnable extends ApiAction
{
    protected Note|null $note = null;

    protected NoteCollaborative|null $noteCollaborative = null;

    /**
     * @throws ValidationException
     */
    public function execute(Note $note, NotePublicEnableDTO $dto)
    {
        $this->note = $note;

        $this->validate([]);

        $this->noteCollaborative = NoteCollaborative::query()
            ->where('note_id', $this->note->getId())
            ->where('owner_id', $this->user()->getId())
            ->first();

        if ($this->noteCollaborative) {
            $this->noteCollaborative->public_active = true;
            $this->noteCollaborative->public_date = Date::now();
            $this->note->shared = true;
        } else {
            $public_key = strtolower(Str::ulid());
            $public_code = StrHelper::getExternalCode();

            $this->noteCollaborative = NoteCollaborative::create([
                'active' => true,
                'public_active' => true,
                'public_key' => $public_key,
                'public_code' => $public_code,
                'public_url' => StrHelper::getFrontendUrl('enotes.share.public', [
                    'key' => $public_key,
                    'code' => $public_code,
                ]),
                'public_date' => Date::now(),
                'note_id' => $this->note->getId(),
                'note_ulid' => $this->note->getUlid(),
                'owner_id' => $this->user()->getId(),
                'supplier_id' => $this->user()->getId(),
                'author_id' => $this->user()->getId(),
                'sort' => SortHelper::getSortValue(),
            ]);
        }

        $this->noteCollaborative->save();
        $this->note->save();
    }

    public function validate(array $data): bool
    {
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
