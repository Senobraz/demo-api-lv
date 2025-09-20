<?php

namespace App\Modules\Enotes\Actions\Collaborative\Notes;

use App\Actions\ApiAction;
use App\Modules\Enotes\DTO\Collaborative\PublicNoteDTO;
use App\Modules\Enotes\Http\Resources\Collaborative\Notes\GetPublicResource;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\NoteCollaborative;
use App\Supports\UserSupport;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Get extends ApiAction
{
    protected Note|null $note = null;

    protected NoteCollaborative|null $noteCollaborative = null;

    /**
     * @throws ValidationException
     */
    public function execute(Note $note, PublicNoteDTO $dto)
    {
        $this->note = $note;

        $this->noteCollaborative = NoteCollaborative::query()
            ->with(['owner.profile', 'note'])
            ->where('active', true)
            ->where('public_active', true)
            ->where('public_key', $dto->getKey())
            ->where('public_code', $dto->getCode())
            ->first();

        $this->validate([]);

        RateLimiter::attempt(
            $this->throttleKey($dto->getIp()),
            1,
            function () {
                $this->noteCollaborative->view_count = $this->noteCollaborative->view_count + 1;
                $this->noteCollaborative->save();
            },
            3600
        );
    }

    public function validate(array $data): bool
    {
        if (!$this->noteCollaborative) {
            throw ValidationException::withMessages([
                'forbidden' => 'An unavailable resource',
            ]);
        }

        if (!UserSupport::existsAccount($this->noteCollaborative->owner)) {
            abort(404, 'An unavailable resource');
        }

        return parent::validate($data);
    }

    protected function throttleKey(string $ip): string
    {
        return Report::class . '|' . $this->noteCollaborative->getUlid() . '|' . $ip;
    }

    protected function resource(): GetPublicResource|array
    {
        return new GetPublicResource($this->noteCollaborative);
    }
}
