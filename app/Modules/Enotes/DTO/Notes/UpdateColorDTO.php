<?php

namespace App\Modules\Enotes\DTO\Notes;

use App\Models\Dictionaries\DictionaryColor;
use Illuminate\Validation\Rule;

class UpdateColorDTO extends NoteDTO
{
    protected function rules(): array
    {
        return [
            'color_id' => ['nullable', 'ulid', Rule::exists(DictionaryColor::class, 'ulid')],
        ];
    }
}
