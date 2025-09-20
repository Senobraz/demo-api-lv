<?php

namespace App\Modules\Enotes\DTO\Notes;

use App\Models\Dictionaries\DictionaryColor;
use App\Modules\Enotes\Models\Section;
use App\Validation\Rules\TiptapLengthRule;
use Illuminate\Validation\Rule;

class UpdateNoteDTO extends NoteDTO
{
    protected function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'heading' => ['nullable', 'array', 'min:1', new TiptapLengthRule(self::LIMIT_HEADING_SIZE)],
            'content' => ['nullable', 'required_without:heading', 'array', 'min:1', new TiptapLengthRule($this->getLimitContentSize())],
            'color_id' => ['nullable', 'ulid', Rule::exists(DictionaryColor::class, 'ulid')],
            'section_id' => ['nullable', 'ulid', Rule::exists(Section::class, 'ulid')],
        ];
    }
}
