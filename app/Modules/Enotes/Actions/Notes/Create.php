<?php

namespace App\Modules\Enotes\Actions\Notes;

use App\Actions\ApiAction;
use App\Helpers\LogHelper;
use App\Helpers\SortHelper;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\DTO\Notes\CreateNoteDTO;
use App\Modules\Enotes\Http\Resources\Notes\NoteResource;
use App\Modules\Enotes\Models\Note;
use App\Supports\UserSupport;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Create extends ApiAction
{
    const LIMIT = 200;

    protected Workspace|null $workspace;

    protected Note|null $note = null;

    /**
     * @throws ValidationException
     */
    public function execute(Workspace $workspace, CreateNoteDTO $dto)
    {
        $this->workspace = $workspace;

        $this->validate([]);

        $this->note = Note::create([
            'workspace_id' => $this->workspace->getId(),
            'section_id' => $dto->getSectionId(),
            'title' => $dto->getTitle(),
            'heading' => $dto->getHeadingJson(),
            'preview' => $dto->getPreviewJson(),
            'content' => $dto->getContentJson(),
            'color_id' => $dto->getColorId(),
            'updated_content_at' => Date::now(),
            'sort' => SortHelper::getSortValue(),
        ]);
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('create', [Note::class, $this->workspace])) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        $user = UserSupport::getUser();

        $count = Note::ofWorkspace($this->workspace->id)->count();

        if ($count >= self::LIMIT && $user->getId() !== 1) {
            $message = 'Лимит на создание заметок превышен: для ' . LogHelper::getUserName($user) . PHP_EOL;

            RateLimiter::attempt(
                Create::class . '_' . $user->getId(),
                1,
                function () use ($message) {
                    try {
                        Log::channel('discord')->warning($message);
                    } catch (\Throwable $e) {
                        Log::info($message);
                    }
                },
                3600
            );

            throw ValidationException::withMessages([
                'forbidden' => __('enotes.alert.note_create_limit', ['count' => self::LIMIT]),
            ]);
        }

        return parent::validate($data);;
    }

    protected function resource(): NoteResource
    {
        $this->note->refresh();

        return new NoteResource($this->note);
    }
}
