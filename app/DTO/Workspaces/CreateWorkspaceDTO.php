<?php

namespace App\DTO\Workspaces;

use App\DTO\BaseDTO;
use App\Models\Dictionaries\DictionaryColor;
use App\Models\Dictionaries\DictionaryIcon;
use App\Models\Module\Module;
use App\Models\Workspace\Workspace;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateWorkspaceDTO extends BaseDTO
{
    protected string|null $name = null;

    protected string|null $description = null;

    protected string|null $module = null;

    protected int|null $type = null;

    protected int|null $status = null;

    protected string|null $avatarColorUlid = null;

    protected string|null $avatarIconUlid = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->name = $data['name'];
        $this->module = $data['module'];
        $this->description = $data['description'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->avatarColorUlid = $data['avatar_color_id'] ?? null;
        $this->avatarIconUlid = $data['avatar_icon_id'] ?? null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getModuleCode(): string
    {
        return $this->module;
    }

    public function getModuleId(): int
    {
        return (int)Module::ofCode($this->getModuleCode())->first('id')->getId();
    }

    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    public function getType(): int
    {
        return $this->type ?? Workspace::TYPE_DEFAULT;
    }

    public function getStatus(): int
    {
        return $this->status ?? Workspace::STATUS_DEFAULT;
    }

    public function getAvatarColorUlid(): ?string
    {
        return $this->avatarColorUlid;
    }

    public function getAvatarColorId(): ?int
    {
        return $this->getAvatarColorUlid() ? DictionaryColor::getIdByUlid($this->getAvatarColorUlid()) : null;
    }

    public function getAvatarIconUlid(): ?string
    {
        return $this->avatarIconUlid;
    }

    public function getAvatarIconId(): ?int
    {
        return $this->getAvatarIconUlid() ? DictionaryIcon::getIdByUlid($this->getAvatarIconUlid()) : null;
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'module' => ['required', 'string', Rule::exists(Module::class, 'code')],
            'description' => ['string'],
            'type' => ['numeric', Rule::in(Workspace::TYPE_DEFAULT)],
            'status' => ['numeric', Rule::in(Workspace::STATUS_DEFAULT)],
            'avatar_color_id' => ['string', Rule::exists(DictionaryColor::class, 'ulid')],
            'avatar_icon_id' => ['string', Rule::exists(DictionaryIcon::class, 'ulid')],
        ];
    }
}
