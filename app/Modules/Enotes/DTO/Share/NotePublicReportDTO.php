<?php

namespace App\Modules\Enotes\DTO\Share;

use App\DTO\BaseDTO;
use App\Modules\Enotes\Models\NoteReport;
use Illuminate\Validation\Rule;

class NotePublicReportDTO extends BaseDTO
{
    protected function rules(): array
    {
        return [
            'type' => ['string', 'required', Rule::in([
                NoteReport::TYPE_SPAM,
                NoteReport::TYPE_INAPPROPRIATE_CONTENT,
                NoteReport::TYPE_OTHER,
            ])],
            'text' => ['string',  'required_if:type,' . NoteReport::TYPE_OTHER]
        ];
    }
}
