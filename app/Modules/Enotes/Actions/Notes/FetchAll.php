<?php

namespace App\Modules\Enotes\Actions\Notes;

use App\Actions\ApiAction;
use App\DTO\FetchListDTO;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Http\Resources\Notes\NoteCollection;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class FetchAll extends ApiAction
{
    protected Workspace|null $workspace;

    protected mixed $notes;

    /**
     * @throws ValidationException
     */
    public function execute(Workspace $workspace, FetchListDTO $dto): void
    {
        $this->workspace = $workspace;

        $this->validate([]);

        $notes = Note::query()
            ->where('workspace_id', $this->workspace->id)
            ->orderBy('id', 'desc')
            ->paginate($dto->getPerPage(), ['*'], $pageName = 'page', $dto->getPage());

        $notes->load('workspace', 'section', 'color');

        $this->notes = $notes;
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

    protected function resource(): NoteCollection | null
    {
        return $this->notes ? new NoteCollection($this->notes) : null;
    }
}
