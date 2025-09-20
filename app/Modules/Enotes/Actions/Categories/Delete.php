<?php

namespace App\Modules\Enotes\Actions\Categories;

use App\Actions\ApiAction;
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

        $isNotEmpty = Section::where('parent_id', $this->section->getId())
            ->select(['id'])
            ->get()
            ->isNotEmpty();

        if ($isNotEmpty) {
            throw ValidationException::withMessages([
                'warning' => __('enotes.alert.category_not_empty'),
            ]);
        }

        return parent::validate($data);;
    }
}
