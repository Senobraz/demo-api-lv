<?php

namespace App\Modules\Enotes\DTO\Notes;

use App\DTO\FetchListDTO;
use App\Modules\Enotes\Models\Section;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FetchNotesDTO extends FetchListDTO
{
    protected string|null $sectionUlid = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->sectionUlid = $data['section_id'] ?? null;
    }

    public function getSectionUlid(): ?string
    {
        return $this->sectionUlid;
    }

    public function getSectionId(): ?int
    {
        return $this->rememberVariable('section_id', function () {
            if (!$this->getSectionUlid()) return null;

            return Section::getIdByUlid($this->getSectionUlid());
        });
    }

    protected function rules(): array
    {
        $parentRules = parent::rules();
        return [
            ...$parentRules,
            [
                'section_id' => ['nullable', 'ulid', Rule::exists(Section::class, 'ulid')],
            ]
        ];
    }
}
