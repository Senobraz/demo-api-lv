<?php

namespace App\Modules\Enotes\Actions\Sections;

use App\Actions\ApiAction;
use App\Modules\Enotes\Models\Note;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Delete extends ApiAction
{
    protected Section $section;

    /**
     * @throws ValidationException
     */
    public function execute(Section $section)
    {
        $this->section = $section;

        $this->validate([]);

        $this->section->delete();
    }

    public function validate(array $data): bool
    {
        if (!Gate::check('delete', $this->section)) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden resource',
            ]);
        }

        $isNotEmpty = Note::where('workspace_id', $this->section->getWorkspaceId())
            ->where('section_id', $this->section->id)
            ->select(['id'])
            ->get()
            ->isNotEmpty();

        if ($isNotEmpty) {
            throw ValidationException::withMessages([
                'warning' => __('enotes.alert.section_not_empty'),
            ]);
        }

        return parent::validate($data);
    }
}
