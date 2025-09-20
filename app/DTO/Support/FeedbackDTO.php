<?php

namespace App\DTO\Support;

use App\DTO\BaseDTO;
use App\Models\Dictionaries\DictionaryIcon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FeedbackDTO extends BaseDTO
{
    protected string|null $subject = null;

    protected string|null $message = null;

    protected string|null $smile = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->subject = $data['subject'];
        $this->message = $data['message'];
        $this->smile = $data['smile'];
    }

    public function getSubject(): ?string
    {
        return $this->subject ? htmlspecialchars($this->subject, ENT_QUOTES, 'UTF-8') : null;
    }

    public function getMessage(): ?string
    {
        return $this->message ? htmlspecialchars($this->message, ENT_QUOTES, 'UTF-8') : null;
    }

    public function getSmile(): ?string
    {
        return $this->smile ?? null;
    }

    protected function rules(): array
    {
        return [
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:500'],
            'smile' => ['nullable', 'string', Rule::exists(DictionaryIcon::class, 'value')
                ->where('package', DictionaryIcon::PACKAGE_FEEDBACK)
            ],
        ];
    }
}
