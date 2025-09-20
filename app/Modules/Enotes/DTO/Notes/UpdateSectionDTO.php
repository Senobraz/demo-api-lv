<?php

namespace App\Modules\Enotes\DTO\Notes;

use App\Modules\Enotes\Models\Section;
use Illuminate\Validation\Rule;

class UpdateSectionDTO extends NoteDTO
{
    protected function rules(): array
    {
        return [
            'section_id' => ['nullable', 'ulid', Rule::exists(Section::class, 'ulid')],
        ];
    }
}
