<?php

namespace App\DTO\Users;

use App\DTO\BaseDTO;
use App\Supports\AppearanceSupport;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateAppearanceDTO extends BaseDTO
{
    protected int|string|null $appearanceMode = null;

    protected string|null $appearanceColor = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->appearanceMode = $data['appearance_mode'];
        $this->appearanceColor = $data['appearance_color'];
    }

    public function getAppearanceMode(): string
    {
        return $this->appearanceMode;
    }

    public function getAppearanceColor(): string
    {
        return $this->appearanceColor;
    }

    protected function rules(): array
    {
        return [
            'appearance_mode' => ['required', 'string', Rule::in(array_keys(AppearanceSupport::getAppearanceModes()))],
            'appearance_color' => ['required', 'string', Rule::in(array_keys(AppearanceSupport::getAppearanceColors()))],
        ];
    }
}
