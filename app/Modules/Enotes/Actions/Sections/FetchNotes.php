<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Actions\ApiAction;
use App\DTO\FetchListDTO;
use App\Modules\Enotes\Http\Resources\Notes\NoteCollection;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class FetchNotes extends ApiAction
{
    protected mixed $notes;

    protected Section|null $section = null;

    /**
     * @throws ValidationException
     */
    public function execute(Section $section, FetchListDTO $dto)
    {
        $this->section = $section;

        $this->validate([]);

        $this->notes = Note
            ::ofWorkspace($this->section->workspace->getId())
            ->where('section_id', $this->section->id)
            ->orderBy('sort', 'desc')
            ->paginate($dto->getPerPage(), $columns = ['*'], $pageName = 'page', $dto->getPage());

        $this->notes->load('workspace', 'section', 'color');
    }

    public function validate(array $data): bool
    {
        parent::validate($data);

        if (!Gate::check('viewAny', [Note::class, $this->section->workspace])) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        if ($this->section && !Gate::check('viewAny', [Section::class, $this->section->workspace])) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        return true;
    }

    protected function resource(): NoteCollection
    {
        return new NoteCollection($this->notes);
    }
}
