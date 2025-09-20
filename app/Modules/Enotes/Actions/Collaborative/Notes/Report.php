<?php

namespace App\Modules\Enotes\Actions\Collaborative\Notes;

use App\Actions\ApiAction;
use App\Modules\Enotes\DTO\Collaborative\ReportNoteDTO;
use App\Modules\Enotes\Models\NoteCollaborative;
use App\Modules\Enotes\Models\NoteReport;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Report extends ApiAction
{
    protected NoteCollaborative|null $noteCollaborative = null;

    protected NoteReport|null $noteReport = null;

    protected bool $notify = true;

    protected int $notifyDelay = 10000;
    /**
     * @throws ValidationException
     */
    public function execute(NoteCollaborative $noteCollaborative, ReportNoteDTO $dto)
    {
        $this->noteCollaborative = $noteCollaborative;

        $this->validate([]);

        $executed = RateLimiter::attempt(
            $this->throttleKey($dto->getIp()),
            1,
            function() use ($dto) {
                $this->noteReport = NoteReport::create([
                    'note_id' => $this->noteCollaborative->getNoteId(),
                    'note_ulid' => $this->noteCollaborative->getNoteUlid(),
                    'type' => $dto->getType(),
                    'text' => $dto->getText(),
                    'ip' => $dto->getIp(),
                ]);

                $this->noteReport->save();
            },
            86400
        );

        if (!$executed) {
            throw ValidationException::withMessages([
                'forbidden' => __('alert.collaborative.report_note_message_throttle'),
            ]);
        }
    }

    public function validate(array $data): bool
    {
        return parent::validate($data);
    }

    protected function throttleKey(string $ip):string
    {
        return 'collaborative_notes_report' . ':' . $this->noteCollaborative->getUlid() . ':' . $ip;
    }

    protected function notifyTitle(): string
    {
        return '';
    }

    protected function notifyMessage(): string
    {
        return __('alert.collaborative.report_note_message_success');
    }

    protected function resource(): array
    {
        return [];
    }
}
