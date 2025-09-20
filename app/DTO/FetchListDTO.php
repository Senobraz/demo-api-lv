<?php

namespace App\DTO;

use Illuminate\Validation\ValidationException;

class FetchListDTO extends BaseDTO
{
    protected int $perPage = 50;

    protected int $page = 1;

    protected string $query = '';

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->perPage = $data['per_page'] ?? $this->perPage;
        $this->page = $data['page'] ?? $this->page;
        $this->query = $data['query'] ?? $this->query;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getSearchText(): string
    {
        return $this->query;
    }

    protected function rules(): array
    {
        return [
            'per_page' => ['nullable', 'integer', 'max:500'],
            'page' => ['nullable', 'integer'],
            'query' => ['nullable', 'string', 'max:255'],
        ];
    }
}
