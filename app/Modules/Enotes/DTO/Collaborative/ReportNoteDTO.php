<?php

namespace App\Modules\Enotes\DTO\Collaborative;

use App\DTO\BaseDTO;
use App\Modules\Enotes\Models\NoteReport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ReportNoteDTO extends BaseDTO
{
    protected int|null $type = null;

    protected string|null $text = null;

    protected string|null $ip = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->type = $data['type'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->ip = $data['ip'] ?? null;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getText(): string
    {
        return strip_tags($this->text);
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    protected function rules(): array
    {
        return [
            'type' => ['required', Rule::in(NoteReport::getTypeCodes())],
            'text' => ['nullable', 'string', 'max:200'],
            'ip' => ['required', 'string', 'max:45', 'ip'],
        ];
    }
}
