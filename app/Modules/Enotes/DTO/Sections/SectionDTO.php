<?php

namespace App\Modules\Enotes\DTO\Sections;

use App\DTO\BaseDTO;
use App\Models\Dictionaries\DictionaryIcon;
use App\Modules\Enotes\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SectionDTO extends BaseDTO
{
    protected string|null $name = null;

    protected string|null $description = null;

    protected string|null $iconUlid = null;

    protected string|null $categoryName = null;

    protected string|null $categoryUlid = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->name = $data['name'] ?? null;
        $this->iconUlid = $data['icon_id'] ?? null;
        $this->categoryName = $data['category_name'] ?? null;
        $this->categoryUlid = $data['category_id'] ?? null;
        $this->description = $data['description'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): int
    {
        return Section::TYPE_DEFAULT;
    }

    public function getIconUlid(): ?string
    {
        return $this->iconUlid;
    }

    public function getIconId(): ?int
    {
        return $this->rememberVariable('icon_id', function () {
            if (!$this->getIconUlid()) return null;

            return DictionaryIcon::getIdByUlid($this->getIconUlid());
        });
    }

    public function getCategoryUlid(): ?string
    {
        return $this->categoryUlid;
    }

    public function getCategoryId(): ?int
    {
        return $this->rememberVariable('category_id', function () {
            if (!$this->getCategoryUlid()) return null;

            return $this->getCategory()->getId();
        });
    }

    public function getCategory(): ?Section
    {
        return $this->rememberVariable('category', function () {
            if (!$this->getCategoryUlid()) return null;

            return Section::getByUlid($this->getCategoryUlid());
        });
    }

    public function getCategoryName(): ?string
    {
        return $this->rememberVariable('category_name', function () {
            if (!$this->getCategoryUlid()) {
                return $this->categoryName;
            }

            return $this->getCategory()->getName();
        });
    }

    public function getDescription(): ?string
    {
        return $this->description ? htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8') : null;
    }

    protected function prepare(&$data): void
    {
        if (isset($data['category']) && $data['category']) {
            if (Str::isUlid($data['category'])) {
                $data['category_id'] = $data['category'];
            } else {
                $data['category_name'] = $data['category'];
            }
        }

        parent::prepare($data);
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'icon_id' => ['nullable', 'ulid', Rule::exists(DictionaryIcon::class, 'ulid')],
            'category' => ['nullable', 'string'],
            'category_id' => ['nullable', 'ulid', Rule::exists(Section::class, 'ulid')],
            'category_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
