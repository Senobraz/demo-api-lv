<?php

namespace App\DTO\Users;

use App\DTO\BaseDTO;
use App\Models\Dictionaries\DictionaryColor;
use App\Models\Dictionaries\DictionaryIcon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateAvatarDTO extends BaseDTO
{
    protected string|null $avatarColor = null;

    protected string|null $avatarIconUlid = null;

    protected string|null $avatarIconColor = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->avatarColor = $data['avatar_color'] ?? null;
        $this->avatarIconUlid = $data['avatar_icon_id'] ?? null;
        $this->avatarIconColor = $data['avatar_icon_color'] ?? null;
    }

    public function getAvatarColor(): ?string
    {
        return $this->avatarColor;
    }

    public function getAvatarIconUlid(): ?string
    {
        return $this->avatarIconUlid;
    }

    public function getAvatarIconId(): ?int
    {
        if (!$this->getAvatarIconUlid()) return null;

        return DictionaryIcon::getIdByUlid($this->getAvatarIconUlid());
    }

    public function getAvatarIconColor(): ?string
    {
        return $this->avatarIconColor;
    }

    protected function rules(): array
    {
        return [
            'avatar_color' => ['nullable', 'string', Rule::exists(DictionaryColor::class, 'value')
                ->where('package', DictionaryColor::PACKAGE_AVATARS)
            ],
            'avatar_icon_id' => ['string', Rule::exists(DictionaryIcon::class, 'ulid')],
            'avatar_icon_color' => ['nullable', 'string'],
        ];
    }
}
