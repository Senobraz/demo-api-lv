<?php

namespace App\Modules\Enotes\Actions\Notes;

use App\Actions\ApiAction;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\DTO\Notes\FetchNotesDTO;
use App\Modules\Enotes\Http\Resources\Notes\NoteCollection;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Search extends ApiAction
{
    protected Workspace|null $workspace;

    protected mixed $notes;

    /**
     * @throws ValidationException
     */
    public function execute(Workspace $workspace, FetchNotesDTO $dto): void
    {
        $this->workspace = $workspace;

        $this->validate([]);

        if ($dto->getSearchText()) {
            $notes = Note::search($dto->getSearchText())
                ->where('workspace_id', $this->workspace->id);

            if($dto->getSectionId()) {
                $notes->where('section_id', $dto->getSectionId());
            }

            $this->notes = $notes->paginate($dto->getPerPage(), $pageName = 'page', $dto->getPage());

            $this->notes->load('workspace', 'section', 'color');
        }
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('viewAny', [Note::class, $this->workspace])) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return parent::validate($data);
    }

    protected function resource(): NoteCollection|null
    {
        return $this->notes ? new NoteCollection($this->notes) : null;
    }
}
